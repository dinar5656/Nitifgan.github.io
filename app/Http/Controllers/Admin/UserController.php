<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request) // Ubah nama method dari `users` menjadi `store`
    {
        // Validasi data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        // Simpan data ke database
        User::create([
            'name' => $validated['name'], 
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
            'role_as' => $validated['role_as'],
        ]);

        // Redirect ke halaman user dengan pesan sukses
        return redirect('/admin/users')->with('message', 'User created successfully.');
    }
    public function edit(int $userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        return redirect('/admin/users')->with('message', 'User updated successfully.');
    }
    public function destroy($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('message', 'User deleted successfully');
        }
        return redirect()->route('users.index')->with('error', 'User not found');
    }
}
