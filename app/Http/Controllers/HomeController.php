<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan halaman untuk Admin
    public function adminHome()
    {
        return view('home-admin.index');  // View untuk home-admin
    }

    // Menampilkan halaman untuk Member
    public function memberHome()
    {
        return view('home-member.index');  // View untuk home-member
    }
}
