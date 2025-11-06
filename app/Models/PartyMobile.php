<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyMobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'label',
        'party_id',
    ];
}
