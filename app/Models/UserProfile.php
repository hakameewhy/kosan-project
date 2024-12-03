<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'user_profiles'; // Nama tabel
    protected $primaryKey = 'user_id'; // Ganti primary key ke 'userid'

    // Jika kolom primary key bukan auto increment, tambahkan properti berikut
    public $incrementing = false;

    // Pastikan kolom primary key adalah tipe string jika bukan integer
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'fullname',
        'phone_number',
        'address',
        'birthday',
        'profile_picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Menyambungkan ke tabel `users`
    }
}