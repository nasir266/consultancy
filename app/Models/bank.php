<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;

    protected $table = 'banks'; // table name as in your screenshot

    protected $fillable = [
        'name',
        'account_title',
        'account_no',
        'balance',
        'remarks',
        'date',
        'status',
    ];
    public $timestamps = false;
}
