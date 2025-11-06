<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\PartyMobile;
use App\Models\PartyLess;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'name',
        'type',
        'area_id',
        'city_id',
        'address',
        'discount',
        'remark',
        'status',
        'bill_limit',
        'duration',
        'care_of',
        'email',
        'whatsapp_greeting',
        'image',
        'file',
        'whatsapp_file',
        'mobile',
        'label'
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function party_mobiles(){
        return $this->hasMany(PartyMobile::class);
    }

    public function party_less(){
        return $this->hasMany(PartyLess::class);
    }
}
