<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.user');
    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'nullable|min:8|max:50',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            $image_path = 'storage/' . $validation['photo']->store('user', 'public');
        }

        $user->photo = $image_path ?? $user->photo;


        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
