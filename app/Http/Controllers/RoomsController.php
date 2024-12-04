<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'rooms_number' => 'required|max:10',
            'status' => 'required|in:tersedia,ditempati',
            'price' => 'required|numeric',
            'room_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar
        $imagePath = $request->file('room_picture')->store('room_pictures', 'public');

        // Menyimpan data room ke database
        $room = new Rooms();
        $room->rooms_number = $validated['rooms_number'];
        $room->status = $validated['status'];
        $room->price = $validated['price'];
        $room->room_picture = $imagePath;
        $room->save();

        return redirect()->back()->with('success', 'Room created successfully!');
    }
}


