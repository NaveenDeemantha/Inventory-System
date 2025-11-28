<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \Inertia\Inertia::render('Users/Index', [
            'users' => \App\Models\User::all(),
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . \App\Models\User::class,
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => 'required|in:admin,super_admin',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index');
    }

    public function edit(\App\Models\User $user)
    {
        return \Inertia\Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . \App\Models\User::class . ',email,' . $user->id,
            'role' => 'required|in:admin,super_admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(\App\Models\User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
