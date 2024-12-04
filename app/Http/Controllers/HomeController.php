<?php

namespace App\Http\Controllers;
use App\Models\Rooms; // Pastikan model Room digunakan untuk mengambil data rooms
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

    //menampilkan data kamar pada homepage
    public function index()
    {
        // Mengambil data rooms dari database
        $rooms = Rooms::all();

        // Mengembalikan view dengan data rooms
        return view('home-admin.index', ['rooms' => $rooms]);
    }
}
