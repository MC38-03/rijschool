<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeerlingController extends Controller
{
    public function index()
    {
        $leerlingen = User::all();
        return view('leerlingen.index', compact('leerlingen'));
    }

    public function create()
    {
        return view('leerlingen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string',
            'achternaam' => 'required|string',
            'leeftijd' => 'required|integer',
            'email' => 'required|email|unique:leerlingen,email',
        ]);

        User::create($validated);
        return redirect()->route('leerlingen.index')->with('success', 'Leerling created successfully.');
    }

    public function show(User $leerling)
    {
        return view('leerlingen.show', compact('leerling'));
    }

    public function edit(User $leerling)
    {
        return view('leerlingen.edit', compact('leerling'));
    }

    public function update(Request $request, User $leerling)
    {
        $validated = $request->validate([
            'naam' => 'required|string',
            'achternaam' => 'required|string',
            'leeftijd' => 'required|integer',
            'email' => 'required|email|unique:leerlingen,email,' . $leerling->id,
        ]);

        $leerling->update($validated);
        return redirect()->route('leerlingen.index')->with('success', 'Leerling updated successfully.');
    }

    public function destroy(User $leerling)
    {
        $leerling->delete();
        return redirect()->route('leerlingen.index')->with('success', 'Leerling deleted successfully.');
    }
}
