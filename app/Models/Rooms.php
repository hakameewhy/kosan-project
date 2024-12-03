<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
