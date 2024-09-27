<?php

namespace App\Http\Controllers;

use App\Models\Les;
use App\Models\Instructeur;
use App\Models\User;
use App\Models\Voertuig;
use Illuminate\Http\Request;

class LesController extends Controller
{
    public function index()
    {
        $lessen = Les::with(['instructeur', 'leerling', 'voertuig'])->get();
        return view('lessen.index', compact('lessen'));
    }

    public function create()
    {
        $instructeurs = Instructeur::all();
        $leerlingen = User::all();
        $voertuigen = Voertuig::all();
        return view('lessen.create', compact('instructeurs', 'leerling', 'voertuigen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerling,id',
            'voertuig_id' => 'nullable|exists:voertuigen,id',
        ]);

        Les::create($validated);
        return redirect()->route('lessen.index')->with('success', 'Les created successfully.');
    }

    public function show(Les $les)
    {
        return view('lessen.show', compact('les'));
    }

    public function edit(Les $les)
    {
        $instructeurs = Instructeur::all();
        $leerlingen = User::all();
        $voertuigen = Voertuig::all();
        return view('lessen.edit', compact('les', 'instructeurs', 'leerling', 'voertuigen'));
    }

    public function update(Request $request, Les $les)
    {
        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerling,id',
            'voertuig_id' => 'nullable|exists:voertuigen,id',
        ]);

        $les->update($validated);
        return redirect()->route('lessen.index')->with('success', 'Les updated successfully.');
    }

    public function destroy(Les $les)
    {
        $les->delete();
        return redirect()->route('lessen.index')->with('success', 'Les deleted successfully.');
    }
}
