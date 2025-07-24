<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name');
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('alert-primary','Data Berhasil ditambah');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('alert-danger','Data Berhasil dihapus');
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $roles = Role::pluck('name');
        return view('pages.users.edit', compact('user','roles'));
    }

   public function update(Request $request, User $user)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $user->syncRoles([$request->role]);

        return redirect()->route('user.index')->with('alert-primary', 'User successfully updated');
    }

}
