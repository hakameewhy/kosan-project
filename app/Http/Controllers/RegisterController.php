<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // Menampilkan Form Register (Opsional)
    public function showMemberRegisterForm()
    {
        return view('auth.register-member'); // View untuk register
    }

    // Proses Registrasi Member
    public function registerMember(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed', // Perlu password_confirmation untuk validasi
            'email'    => 'required|string|email|max:255|unique:users,email',
            'role'     => 'required|in:admin,member' // Hanya menerima admin/member jika diubah opsinya
        ]);

        // Tambahkan data ke database
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role = $request->role; // role bisa diisi langsung dari input hidden
        $user->save();

        // Redirect dengan pesan sukses
        return redirect('/')->with('success', 'Registrasi berhasil, silakan login.');
    }
}