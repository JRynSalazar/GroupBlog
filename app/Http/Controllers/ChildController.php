<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function aboutUs()
    {
        return view('child.aboutus');
    }
    public function profileName($name = null)
    {
        if ($name) {
            
            return view('child.profile', ['name' => $name]);
        } else {
            
            return view('child.profile');
        }
    }

    public function profile()
    {
        return view('child.profile');
    }


   
}

