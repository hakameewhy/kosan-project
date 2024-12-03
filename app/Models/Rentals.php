<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    use HasFactory;
    protected $fillable =[
        'idrentals',
        'roomsid',
        'id',
        'startdate',
        'enddate',
        'status'
    ];
}
