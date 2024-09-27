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
            'license_plate' => 'required|string|max:255',
        ]);
    

        Voertuig::create($validated);
    
        return redirect()->route('voertuigen.index')->with('success', 'Voertuig created successfully.');
    }
    

    public function show(Voertuig $voertuig)
    {
        return view('voertuigen.show', compact('voertuig'));
    }

    public function edit(Voertuig $voertuig)
    {
        return view('voertuigen.edit', compact('voertuig'));
    }

    public function update(Request $request, Voertuig $voertuig)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        $voertuig->update($validated);
        return redirect()->route('voertuigen.index')->with('success', 'Voertuig updated successfully.');
    }

    public function destroy(Voertuig $voertuig)
    {
        $voertuig->delete();
        return redirect()->route('voertuigen.index')->with('success', 'Voertuig deleted successfully.');
    }
}
