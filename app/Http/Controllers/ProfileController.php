<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => request()->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'username' => ['required', 'alpha_dash', Rule::unique('users')->ignore($user)],
        ]);

        $user->update($data);

        return back()->with('status', 'Profile updated.');
    }

    public function password(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        abort_unless(Hash::check($data['current_password'], $request->user()->password), 422);
        $request->user()->update(['password' => $data['password']]);

        return back()->with('status', 'Password changed.');
    }
}
