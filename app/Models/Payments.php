<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable =[
        'idpayments',
        'idrentals',
        'price',
        'paymentdate',
        'status'
    ];
}