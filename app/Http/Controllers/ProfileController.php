<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk menyimpan file foto

class ProfileController extends Controller
{
    public function show()
    {
        $profile = auth()->user()->profile;
        $wishlistCount = Wishlist::where('user_id', auth()->id())->count();
        $orderCount = Order::where('user_id', auth()->id())->count();
        $totalPrice = Order::where('user_id', auth()->id())
            ->with('orderItems') // Memuat relasi order items
            ->get()
            ->flatMap(function ($order) {
                return $order->orderItems;
            })
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });

        return view('profile.show', compact('profile','wishlistCount', 'orderCount', 'totalPrice'));
    }

    public function edit()
    {
        $profile = auth()->user()->profile;
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi foto
        ]);

        $profile = auth()->user()->profile;

        // Jika profil belum ada, buatkan profil baru
        if (!$profile) {
            $profile = new UserProfile();
            $profile->user_id = auth()->id();
        }

        // Simpan foto jika ada
        if ($request->hasFile('photo')) {
            // Menghapus foto lama jika ada
            if ($profile->photo && Storage::exists('public/' . $profile->photo)) {
                Storage::delete('public/' . $profile->photo);
            }

            // Menyimpan foto baru di folder 'uploads/profil' di dalam folder 'public'
            $fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('uploads/profil', $fileName, 'public');
            $profile->photo = 'uploads/profil/' . $fileName;
        }

        // Mengisi data profil lainnya
        $profile->fill($request->only('address', 'phone', 'bio', 'username', 'email'));

        // Simpan perubahan profil
        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
}
