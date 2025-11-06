<?php

namespace App\Imports;

use App\Models\Party;
use App\Models\PartyMobile;
use App\Models\City;
use App\Models\Area;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class ContactsImport implements ToCollection
{
    public int $created = 0;
    public int $skipped = 0;
    public array $errors = [];

    public function collection(Collection $rows)
    {
        /*if ($rows->isEmpty()) {
            return;
        }*/

        // Drop header row
        $rows->shift();

        foreach ($rows as $index => $row) {
            $row = is_array($row) ? $row : $row->toArray();
            $get = fn($i) => isset($row[$i]) ? trim((string)$row[$i]) : '';

            // Map columns
            $name     = $get(0);
            $mobile   = $this->normalizeMobile($get(1));
            $label    = $get(2);
            $type     = $get(15);
            $cityName = $get(16);
            $areaName = $get(17);
            $address  = $get(18);

            // Collect extra mobiles (cols 3–14)
            $extraMobiles = [];
            for ($i = 1; $i <= 6; $i++) {
                $m = $this->getIndex($row, ($i * 2) + 1); // 3,5,7,9,11,13
                $l = $this->getIndex($row, ($i * 2) + 2); // 4,6,8,10,12,14
                $m = $this->normalizeMobile($m);
                $l = trim((string)$l);

                if ($m !== '') {
                    $extraMobiles[] = ['mobile' => $m, 'label' => $l ?: 'Other'];
                }
            }

            // Validation
            $missing = [];
            if ($name === '')     $missing[] = 'name';
            if ($mobile === '')   $missing[] = 'main mobile';
            if ($label === '')    $missing[] = 'label';
            if ($type === '')     $missing[] = 'type';
            //if ($cityName === '') $missing[] = 'city';
            //if ($areaName === '') $missing[] = 'area';

            if (!empty($missing)) {
                $this->skipped++;
                $this->errors[] = [
                    'row'      => $index + 2,
                    'mobile'   => $mobile ?: 'N/A',
                    'party_id' => null,
                    'reason'   => 'Missing ' . implode(', ', $missing),
                ];
                continue;
            }

            // Check duplicate for ALL mobiles (main + extras)
            $allMobiles = array_merge([$mobile], array_column($extraMobiles, 'mobile'));
            $duplicate = null;

            foreach ($allMobiles as $m) {
                if ($m === '') continue;

                $party = Party::where('mobile', $m)->first();
                if ($party) {
                    $duplicate = ['mobile' => $m, 'party_id' => $party->id];
                    break;
                }

                $partyMobile = PartyMobile::where('mobile', $m)->first();
                if ($partyMobile) {
                    $duplicate = ['mobile' => $m, 'party_id' => $partyMobile->party_id];
                    break;
                }
            }

            if ($duplicate) {
                $this->skipped++;
                $this->errors[] = [
                    'row'      => $index + 2,
                    'mobile'   => $duplicate['mobile'],
                    'party_id' => $duplicate['party_id'],
                    'reason'   => "Duplicate mobile {$duplicate['mobile']}",
                ];
                continue;
            }

            // Insert new record
            try {
                DB::transaction(function () use ($name, $mobile, $label, $type, $cityName, $areaName, $address, $extraMobiles) {
                    $city = City::firstOrCreate(['name' => $cityName]);

                    $area = Area::firstOrCreate([
                        'city_id' => $city->id,
                        'name'    => $areaName,
                    ]);

                    $party = Party::create([
                        'date'    => date('Y-m-d'),
                        'name'    => $name,
                        'mobile'  => $mobile,
                        'label'   => $label,
                        'type'    => $type,
                        'address' => $address,
                        'area_id' => $area->id,
                        'status'  => 'Active',
                    ]);

                    foreach ($extraMobiles as $em) {
                        PartyMobile::create([
                            'party_id' => $party->id,
                            'mobile'   => $em['mobile'],
                            'label'    => $em['label'],
                        ]);
                    }
                });

                $this->created++;
            } catch (\Throwable $e) {
                $this->skipped++;
                $this->errors[] = [
                    'row'      => $index + 2,
                    'mobile'   => $mobile ?: 'N/A',
                    'party_id' => null,
                    'reason'   => 'DB Error: ' . $e->getMessage(),
                ];
            }
        }
    }

    private function getIndex($row, $i)
    {
        return isset($row[$i]) ? $row[$i] : '';
    }

    private function normalizeMobile($number): string
    {
        $number = trim((string)$number);
        $number = preg_replace('/\s+/', '', $number);     // remove spaces
        $number = preg_replace('/[^0-9]/', '', $number);  // keep only digits

        if ($number === '') {
            return '';
        }

        // If starts with 3 (e.g., 301...), add 0 at the start
        if (str_starts_with($number, '3') && strlen($number) === 10) {
            return '0' . $number;
        }

        // If starts with 0 and length is 11, keep as is
        if (str_starts_with($number, '0') && strlen($number) === 11) {
            return $number;
        }

        // Otherwise return as-is (fallback)
        return $number;
    }

}
