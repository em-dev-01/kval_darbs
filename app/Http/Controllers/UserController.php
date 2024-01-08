<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::all(),
        ]);
    }

    public function show($id)
    {
        return view('users.show', [
            'user' => User::find($id),
        ]);
    }

    public function accept(User $user)
    {
        $user->accepted_status = true;
        $user->save();

        return redirect()->back()->with('success', 'Lietotājs apstiprināts');
    }

    public function deny(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Lietotājs noraidīts');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Lietotājs dzēsts');
    }
}
