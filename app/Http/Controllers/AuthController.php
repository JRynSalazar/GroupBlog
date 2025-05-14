<?php


namespace App\Http\Controllers;

use App\Models\User;

use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function showRegisterForm()
{
    if (Auth::check()) {
       
        return redirect()->route('admin.dashboard');
    }

    return view('register');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|numeric|min:10|max:100',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'bio' => 'nullable|string|max:500',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
    }

    $user = User::create([
        'name' => $request->name,
        'age' => $request->age,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type' => $request->input('user_type', 'user'),
        'bio' => $request->bio,
        'profile_image' => $imagePath ?? 'images/default-profile.png',
    ]);

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
}



    public function showLoginForm()
    {

        if (Auth::check()) {
            return redirect()->route('user.udashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); 

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('admin.dashboard', ['name' => $user->name]);;
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user.udashboard');
    }

    public function userDashboard()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'You need to login first.');
    }

    $postCount = PostComment::where('user_id', $user->id)->count() ?? 0;

    dd($postCount);

    return view('child.profile', compact('user', 'postCount'));
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

        return redirect()->route('child.profile')->with('success', 'Profile image updated successfully.');
    }
}
