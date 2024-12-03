<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    /**
     * Menyimpan atau memperbarui profil pengguna.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'birthday' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        // Menyimpan gambar profil jika ada
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Mengecek apakah profil sudah ada
        $userProfile = UserProfile::where('user_id', Auth::id())->first();

        if ($userProfile) {
            // Jika profil sudah ada, lakukan update
            $userProfile->fullname = $request->input('fullname');
            $userProfile->address = $request->input('address');
            $userProfile->phone_number = $request->input('phone');
            $userProfile->birthday = $request->input('birthday');

            // Jika ada gambar profil baru, simpan dan update
            if ($request->hasFile('profile_picture')) {
                // Hapus gambar lama jika ada
                if ($userProfile->profile_picture) {
                    Storage::disk('public')->delete($userProfile->profile_picture);
                }
                $userProfile->profile_picture = $profilePicturePath;
            }

            $userProfile->save();

            return redirect()->back()->with('success', 'Profile successfully updated!');
        } else {
            // Jika profil belum ada, buat profil baru
            $userProfile = new UserProfile();
            $userProfile->user_id = Auth::id(); // Ambil user_id dari pengguna yang sedang login
            $userProfile->fullname = $request->input('fullname');
            $userProfile->address = $request->input('address');
            $userProfile->phone_number = $request->input('phone');
            $userProfile->birthday = $request->input('birthday');
            $userProfile->profile_picture = $profilePicturePath;
            $userProfile->save();

            return redirect()->back()->with('success', 'Profile successfully created!');
        }
    }

    /**
     * Menghapus gambar profil pengguna.
     */
    public function deletePicture()
{
    $userProfile = UserProfile::where('user_id', Auth::id())->first();

    if ($userProfile && $userProfile->profile_picture) {
        Storage::disk('public')->delete($userProfile->profile_picture);
        $userProfile->profile_picture = null;
        $userProfile->save();

        return response()->json(['success' => 'Profile picture deleted successfully!']);
    }

    return response()->json(['error' => 'Failed to delete profile picture.'], 500);
}

}
