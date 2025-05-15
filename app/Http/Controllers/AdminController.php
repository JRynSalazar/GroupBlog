<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
public function dashboard()
{
    $user = Auth::user(); // get currently authenticated user

    // no need to check $name because no URL param now

    return view('admin.dashboard', ['name' => $user->name]);
}

}
