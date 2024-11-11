<?php

namespace App\Http\Controllers;

use App\Models\Beschikbaarheid;
use App\Models\Instructeur;
use Illuminate\Http\Request;

class BeschikbaarheidController extends Controller
{
    public function index()
    {
        $beschikbaarheden = Beschikbaarheid::with('instructeur')->get();
        return view('beschikbaarheden.index', compact('beschikbaarheden'));
    }

    public function create()
    {
        $instructeurs = Instructeur::all();
        return view('beschikbaarheden.create', compact('instructeurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
        ]);

        Beschikbaarheid::create($validated);
        return redirect()->route('beschikbaarheden.index')->with('success', 'Beschikbaarheid created successfully.');
    }

    public function show($id)
    {        $beschikbaarheid = Beschikbaarheid::with('instructeur')->findOrFail($id);
        return view('beschikbaarheden.show', compact('beschikbaarheid'));
    }

    public function edit($id)
    {

        $beschikbaarheid = Beschikbaarheid::findOrFail($id);
        $instructeurs = Instructeur::all();
        return view('beschikbaarheden.edit', compact('beschikbaarheid', 'instructeurs'));
    }

    public function update(Request $request, $id)
    {
        $beschikbaarheid = Beschikbaarheid::findOrFail($id);

        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
        ]);

        $beschikbaarheid->update($validated);
        return redirect()->route('beschikbaarheden.index')->with('success', 'Beschikbaarheid updated successfully.');
    }

    public function destroy($id)
    {
        $beschikbaarheid = Beschikbaarheid::findOrFail($id);

        $beschikbaarheid->delete();
        return redirect()->route('beschikbaarheden.index')->with('success', 'Beschikbaarheid deleted successfully.');
    }
}
