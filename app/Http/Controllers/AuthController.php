<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome'); // Menampilkan form login
    }

    public function login(Request $request)
    {
        // Validasi login
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'roles'    => 'required|in:admin,member',
        ]);

        // Cari user berdasarkan username dan role
        $user = User::where([
            ['username', $request->username],
            ['role', $request->roles]
        ])->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Login user
            Auth::login($user);

            // Redirect berdasarkan role
            if ($user->role == 'admin') {
                return redirect()->route('home.admin');
            } elseif ($user->role == 'member') {
                return redirect()->route('home.member');
            }
        } else {
            return back()->withErrors(['login' => 'Username, password, atau role tidak sesuai']);
        }
    }
}
