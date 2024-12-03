<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Fungsi login untuk Owner
    public function ownerLogin(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('role', 'admin')->first(); // Misalkan hanya ada satu admin (owner)
        
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('owner.dashboard'); // Ganti dengan halaman owner
        }

        return back()->withErrors(['password' => 'Password salah atau akun tidak ditemukan']);
    }

    // Fungsi login untuk Member
    public function memberLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,member', // Pastikan role yang dimasukkan sesuai
        ]);

        $user = User::where('username', $request->username)->where('role', $request->role)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('home'); // Ganti dengan halaman member
        }

        return back()->withErrors(['login' => 'Username, password, atau role tidak sesuai']);
    }
}
