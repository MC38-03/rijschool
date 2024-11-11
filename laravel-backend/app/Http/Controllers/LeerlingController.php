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
            'email' => 'required|email|unique:leerling,email',
        ]);

        User::create($validated);
        return redirect()->route('leerlingen.index')->with('success', 'Leerling created successfully.');
    }

    public function show($id)
    {
        $leerling = User::findOrFail($id);
        return view('leerlingen.show', compact('leerling'));
    }

    public function edit($id)
    {
        $leerling = User::findOrFail($id);
        return view('leerlingen.edit', compact('leerling'));
    }

    public function update(Request $request, $id)
    {
        $leerling = User::findOrFail($id);

        $validated = $request->validate([
            'naam' => 'required|string',
            'achternaam' => 'required|string',
            'leeftijd' => 'required|integer',
            'email' => 'required|email|unique:leerling,email,' . $id,
        ]);

        $leerling->update($validated);
        return redirect()->route('leerlingen.index')->with('success', 'Leerling updated successfully.');
    }

    public function destroy($id)
    {
        $leerling = User::findOrFail($id);
        $leerling->delete();
        return redirect()->route('leerlingen.index')->with('success', 'Leerling deleted successfully.');
    }
}
