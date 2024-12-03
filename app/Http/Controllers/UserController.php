<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan form register (buat akun)
    public function create()
    {
        return view('register'); // Mengarah ke tampilan register
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8|confirmed', // password and confirmation
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:member', // Role default member
        ]);
        

        // Membuat akun baru
        $user = new User();
        $user->username = $validated['username'];
        $user->password = bcrypt($validated['password']);
        $user->email = $validated['email'];
        $user->role = $validated['role']; // Default role member
        $user->save();

        // Redirect ke halaman login setelah berhasil registrasi
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login');
    }
}
