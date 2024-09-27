<?php

namespace App\Http\Controllers;

use App\Models\Factuur;
use App\Models\User;
use App\Models\Instructeur;
use Illuminate\Http\Request;

class FactuurController extends Controller
{
    public function index()
    {
        $facturen = Factuur::with(['leerling', 'instructeur'])->get();
        return view('facturen.index', compact('facturen'));
    }

    public function create()
    {
        $leerlingen = User::all();
        $instructeurs = Instructeur::all();
        return view('facturen.create', compact('leerlingen', 'instructeurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerlingen,id',
            'bedrag' => 'required|numeric|min:0',
            'datum_uitgegeven' => 'required|date',
            'verval_datum' => 'required|date',
            'status' => 'required|in:open,betaald',
        ]);

        Factuur::create($validated);
        return redirect()->route('facturen.index')->with('success', 'Factuur created successfully.');
    }

    public function show(Factuur $factuur)
    {
        return view('facturen.show', compact('factuur'));
    }

    public function edit(Factuur $factuur)
    {
        $leerlingen = User::all();
        $instructeurs = Instructeur::all();
        return view('facturen.edit', compact('factuur', 'leerlingen', 'instructeurs'));
    }

    public function update(Request $request, Factuur $factuur)
    {
        $validated = $request->validate([
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerlingen,id',
            'bedrag' => 'required|numeric|min:0',
            'datum_uitgegeven' => 'required|date',
            'verval_datum' => 'required|date',
            'status' => 'required|in:open,betaald',
        ]);

        $factuur->update($validated);
        return redirect()->route('facturen.index')->with('success', 'Factuur updated successfully.');
    }

    public function destroy(Factuur $factuur)
    {
        $factuur->delete();
        return redirect()->route('facturen.index')->with('success', 'Factuur deleted successfully.');
    }
}
