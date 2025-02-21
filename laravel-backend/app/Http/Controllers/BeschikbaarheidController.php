<?php

namespace App\Http\Controllers;

use App\Models\Beschikbaarheid;
use App\Models\Instructeur;
use App\Models\Voertuig;
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
        $voertuigen = Voertuig::all();
        return view('beschikbaarheden.create', compact('instructeurs', 'voertuigen'));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
            'voertuig_id' => 'required|exists:voertuigen,id',
        ]);
    
        Beschikbaarheid::create($validated);
    
        return redirect()->route('beschikbaarheden.index')->with('success', 'Beschikbaarheid toegevoegd.');
    }
    

    public function show($id)
    {        $beschikbaarheid = Beschikbaarheid::with('instructeur')->findOrFail($id);
        return view('beschikbaarheden.show', compact('beschikbaarheid'));
    }

    public function edit($id)
    {
        $beschikbaarheid = Beschikbaarheid::findOrFail($id);
        $instructeurs = Instructeur::all();
        $voertuigen = Voertuig::all();
        return view('beschikbaarheden.edit', compact('beschikbaarheid', 'instructeurs', 'voertuigen'));
    }
    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
            'voertuig_id' => 'required|exists:voertuigen,id',
        ]);
    
        $beschikbaarheid = Beschikbaarheid::findOrFail($id);
        $beschikbaarheid->update($validated);
    
        return redirect()->route('beschikbaarheden.index')->with('success', 'Beschikbaarheid bijgewerkt.');
    }
    

    public function destroy($id)
    {
        $beschikbaarheid = Beschikbaarheid::findOrFail($id);

        $beschikbaarheid->delete();
        return redirect()->route('beschikbaarheden.index')->with('success', 'Beschikbaarheid deleted successfully.');
    }
}
