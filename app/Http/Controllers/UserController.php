<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
        $editUser = null;

        if ($request->has('edit')) {
            $editUser = User::find($request->edit);
        }

        return view('manajemen.user.main', compact('users', 'editUser'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,unit',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        session()->flash('success', 'User berhasil ditambahkan!');

        return redirect()->route('manajemen.user.index');
    }


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,unit',
            'password' => 'nullable|min:6', // Password opsional, hanya jika ingin diubah
        ]);

        // Update nama, email, dan role
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika password baru disertakan, perbarui password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();
        session()->flash('success', 'User berhasil diperbarui!');

        return redirect()->route('manajemen.user.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User berhasil dihapus!');

        return redirect()->route('manajemen.user.index');
    }
}
