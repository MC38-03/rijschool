<?php

namespace App\Http\Controllers;

use App\Models\Voertuig;
use Illuminate\Http\Request;

class VoertuigController extends Controller
{
    public function index()
    {
        $voertuigen = Voertuig::all();
        return view('voertuigen.index', compact('voertuigen'));
    }

    public function create()
    {
        return view('voertuigen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:voertuigen,license_plate',
        ]);

        Voertuig::create($validated);
        return redirect()->route('voertuigen.index')->with('success', 'Voertuig created successfully.');
    }

    public function show($id)
    {
        $voertuig = Voertuig::findOrFail($id);
        return view('voertuigen.show', compact('voertuig'));
    }

    public function edit($id)
    {
        $voertuig = Voertuig::findOrFail($id);
        return view('voertuigen.edit', compact('voertuig'));
    }

    public function update(Request $request, $id)
    {
        $voertuig = Voertuig::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:voertuigen,license_plate,' . $id,
        ]);

        $voertuig->update($validated);
        return redirect()->route('voertuigen.index')->with('success', 'Voertuig updated successfully.');
    }

    public function destroy($id)
    {
        $voertuig = Voertuig::findOrFail($id);
        $voertuig->delete();
        return redirect()->route('voertuigen.index')->with('success', 'Voertuig deleted successfully.');
    }
}
