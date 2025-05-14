<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard($name)
    {
        $user = Auth::user();

        if ($user->name !== $name) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard', compact('name'));
    }
}
