<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'roomsid',
        'rooms_number',
        'status',
        'price'
    ];

}
