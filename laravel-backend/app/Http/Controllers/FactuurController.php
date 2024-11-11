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
            'leerling_id' => 'required|exists:leerling,id',
            'bedrag' => 'required|numeric|min:0',
            'datum_uitgegeven' => 'required|date',
            'verval_datum' => 'required|date',
            'status' => 'required|in:open,betaald',
        ]);

        Factuur::create($validated);
        return redirect()->route('facturen.index')->with('success', 'Factuur created successfully.');
    }

    public function show($id)
    {
        $factuur = Factuur::with(['leerling', 'instructeur'])->find($id);

        if (!$factuur) {
            return redirect()->route('facturen.index')->withErrors('Factuur not found.');
        }

        return view('facturen.show', compact('factuur'));
    }

    public function edit($id)
    {
        $factuur = Factuur::find($id);
        if (!$factuur) {
            return redirect()->route('facturen.index')->withErrors('Factuur not found.');
        }

        $leerlingen = User::all();
        $instructeurs = Instructeur::all();
        return view('facturen.edit', compact('factuur', 'leerlingen', 'instructeurs'));
    }

    public function update(Request $request, $id)
    {
        $factuur = Factuur::find($id);
        if (!$factuur) {
            return redirect()->route('facturen.index')->withErrors('Factuur not found.');
        }

        $validated = $request->validate([
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerling,id',
            'bedrag' => 'required|numeric|min:0',
            'datum_uitgegeven' => 'required|date',
            'verval_datum' => 'required|date',
            'status' => 'required|in:open,betaald',
        ]);

        $factuur->update($validated);
        return redirect()->route('facturen.index')->with('success', 'Factuur updated successfully.');
    }

    public function destroy($id)
    {
        $factuur = Factuur::find($id);
        if (!$factuur) {
            return redirect()->route('facturen.index')->withErrors('Factuur not found.');
        }

        $factuur->delete();
        return redirect()->route('facturen.index')->with('success', 'Factuur deleted successfully.');
    }
}
