<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable =[
        'idreviews',
        'roomsid',
        'id',
        'rating',
        'comment'
    ];
}
