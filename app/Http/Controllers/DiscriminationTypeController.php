<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscriminationType;

class DiscriminationTypeController extends Controller
{

    public function index()
    {
        $types = DiscriminationType::all();
        return view('discrimination_type.index', compact('types'));
    }

    public function create()
    {
        return view('discrimination_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);

        DiscriminationType::create([
            'type' => $request->type,
        ]);

        return redirect()->route('discrimination-type.index')->with('success', 'Type added successfully!');
    }

    public function show(DiscriminationType $discriminationType)
    {
        return view('discrimination_type.show', compact('discriminationType'));
    }

    public function edit(DiscriminationType $discriminationType)
    {
        return view('discrimination_type.edit', compact('discriminationType'));
    }

    public function update(Request $request, DiscriminationType $discriminationType)
    {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $discriminationType->update([
            'type' => $request->type,
        ]);

        return redirect()->route('discrimination-type.index')->with('success', 'Type updated successfully!');
    }

    public function destroy(DiscriminationType $discriminationType)
    {
        $discriminationType->delete();
        return redirect()->route('discrimination-type.index')->with('success', 'Type deleted successfully!');
    }
}
