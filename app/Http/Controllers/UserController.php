<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userDashboard()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'You need to login first.');
    }

    // $post_count = PostComment::where('user_id', $user->id)->count() ?? 0;

    $postCount = 5;

    return view('child.profile', compact('user', 'post_count'));
}


    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imagePath = $image->store('profile_images', 'public');

            $user->author_image = $imagePath;
            $user->save();
        }

        return redirect()->route('user.dashboard')->with('success', 'Profile image updated successfully.');
    }

    // In ProfileController.php
public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|integer',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'bio' => 'nullable|string',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->age = $request->age;
    $user->email = $request->email;
    $user->bio = $request->bio;

    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


public function dashboard($name)
{
    $user = Auth::user();

    if ($user->name !== $name) {
        abort(403, 'Unauthorized action.');
    }
    return view('admin.dashboard', compact('name'));
}
}
