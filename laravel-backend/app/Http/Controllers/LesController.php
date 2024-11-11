<?php

namespace App\Http\Controllers;

use App\Models\Les;
use App\Models\Instructeur;
use App\Models\User;
use App\Models\Voertuig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\LessonNotification;
use Illuminate\Support\Facades\Mail;


class LesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $lessen = Les::where('leerling_id', $user->id)
            ->orWhere('instructeur_id', $user->id)
            ->with(['leerling', 'instructeur', 'voertuig'])
            ->get();

        return view('lessen.index', compact('lessen'));
    }

    public function studentSchedule()
    {
        $user = Auth::user();
        $lessen = Les::where('leerling_id', $user->id)
            ->with(['instructeur', 'voertuig'])
            ->get();

        return view('lessen.student_schedule', compact('lessen'));
    }


    public function create()
    {
        $instructeurs = Instructeur::all();
        $leerlingen = User::all();
        $voertuigen = Voertuig::all();
        return view('lessen.create', compact('instructeurs', 'leerlingen', 'voertuigen'));
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
    
        $les = Les::create($validated);
    
        if ($les->leerling) {
            Mail::to($les->leerling->email)->send(new LessonNotification($les, 'created'));
        }
    
        return redirect()->route('lessen.index')->with('success', 'Les created successfully.');
    }
    

    public function show($id)
    {
        $les = Les::findOrFail($id);
        return view('lessen.show', compact('les'));
    }

    public function edit($id)
    {
        $les = Les::findOrFail($id);
        $instructeurs = Instructeur::all();
        $leerlingen = User::all();
        $voertuigen = Voertuig::all();
        return view('lessen.edit', compact('les', 'instructeurs', 'leerlingen', 'voertuigen'));
    }

    public function update(Request $request, $id)
    {
        $les = Les::findOrFail($id);
    
        $validated = $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i',
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerling,id',
            'voertuig_id' => 'nullable|exists:voertuigen,id',
        ]);
    
        $les->update($validated);
    
        if ($les->leerling) {
            Mail::to($les->leerling->email)->send(new LessonNotification($les, 'updated'));
        }
    
        return redirect()->route('lessen.index')->with('success', 'Les updated successfully.');
    }

    public function destroy($id)
    {
        $les = Les::findOrFail($id);
        $les->delete();
        return redirect()->route('lessen.index')->with('success', 'Les deleted successfully.');
    }
}
