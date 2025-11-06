<?php

namespace App\Imports;

use App\Models\Party;
use App\Models\City;
use App\Models\Area;
use App\Models\PartyMobile;
use App\Models\PartyLess;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartyImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $r = $row->toArray();

        if (!$r['name']) return;

        // Avoid duplicate party
        $party = Party::where('name', $r['name'])->first();
        if ($party) return;

        // City
        $city = City::firstOrCreate(['name' => $r['city']]);

        // Area (if available)
        $area = null;
        if (!empty($r['area'])) {
            $area = Area::firstOrCreate([
                'name' => $r['area'],
                'city_id' => $city->id
            ]);
        }

        // Create Party
        $party = Party::create([
            'name' => $r['name'],
            'type' => $r['type'] ?? null,
            'remark' => $r['remark'] ?? null,
            'area_id' => $area ? $area->id : null,
        ]);

        // Mobiles
        for ($i = 0; $i < 3; $i++) {
            $mobileKey = $i === 0 ? 'mobile' : 'mobile.' . $i;
            $labelKey = $i === 0 ? 'label' : 'label.' . $i;

            if (!empty($r[$mobileKey])) {
                PartyMobile::create([
                    'party_id' => $party->id,
                    'mobile' => $r[$mobileKey],
                    'label' => $r[$labelKey] ?? null,
                ]);
            }
        }

        // Lesses
        for ($i = 0; $i < 3; $i++) {
            $from = $i === 0 ? 'from' : 'from.' . $i;
            $to = $i === 0 ? 'to' : 'to.' . $i;
            $less = $i === 0 ? 'less' : 'less.' . $i;

            if (!empty($r[$from]) || !empty($r[$to]) || !empty($r[$less])) {
                PartyLess::create([
                    'party_id' => $party->id,
                    'from' => $r[$from] ?? null,
                    'to' => $r[$to] ?? null,
                    'less' => $r[$less] ?? null,
                ]);
            }
        }
    }
}
