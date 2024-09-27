<?php

namespace App\Http\Controllers;

use App\Models\Instructeur;
use App\Models\Voertuig;
use Illuminate\Http\Request;

class InstructeurController extends Controller
{
    public function index()
    {
        $instructeurs = Instructeur::with('voertuig')->get();
        return view('instructeurs.index', compact('instructeurs'));
    }

    public function create()
    {
        $voertuigen = Voertuig::all();
        return view('instructeurs.create', compact('voertuigen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string',
            'achternaam' => 'required|string',
            'email' => 'required|email|unique:instructeurs,email',
            'voertuig_id' => 'nullable|exists:voertuigen,id',
        ]);

        Instructeur::create($validated);
        return redirect()->route('instructeurs.index')->with('success', 'Instructeur created successfully.');
    }

    public function show(Instructeur $instructeur)
    {
        return view('instructeurs.show', compact('instructeur'));
    }

    public function edit(Instructeur $instructeur)
    {
        $voertuigen = Voertuig::all();
        return view('instructeurs.edit', compact('instructeur', 'voertuigen'));
    }

    public function update(Request $request, Instructeur $instructeur)
    {
        $validated = $request->validate([
            'naam' => 'required|string',
            'achternaam' => 'required|string',
            'email' => 'required|email|unique:instructeurs,email,' . $instructeur->id,
            'voertuig_id' => 'nullable|exists:voertuigen,id',
        ]);

        $instructeur->update($validated);
        return redirect()->route('instructeurs.index')->with('success', 'Instructeur updated successfully.');
    }

    public function destroy(Instructeur $instructeur)
    {
        $instructeur->delete();
        return redirect()->route('instructeurs.index')->with('success', 'Instructeur deleted successfully.');
    }
}
