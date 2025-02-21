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
use App\Models\Beschikbaarheid;


class LesController extends Controller
{



    public function checkAvailability(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'begin_tijd' => 'required|date_format:H:i',
            'eind_tijd' => 'required|date_format:H:i|after:begin_tijd',
            'instructeur_id' => 'required|exists:instructeurs,id',
        ]);

        // Check beschikbaarheid
        $beschikbaarheid = Beschikbaarheid::where('instructeur_id', $request->instructeur_id)
            ->where('datum', $request->datum)
            ->where('begin_tijd', '<=', $request->begin_tijd)
            ->where('eind_tijd', '>=', $request->eind_tijd)
            ->first();

        if (!$beschikbaarheid) {
            return response()->json(['available' => false, 'message' => 'De instructeur is niet beschikbaar op dit moment.']);
        }

        // Prevent double booking
        $existingLesson = Les::where('instructeur_id', $request->instructeur_id)
            ->where('datum', $request->datum)
            ->where(function ($query) use ($request) {
                $query->whereBetween('begin_tijd', [$request->begin_tijd, $request->eind_tijd])
                    ->orWhereBetween('eind_tijd', [$request->begin_tijd, $request->eind_tijd]);
            })
            ->first();

        if ($existingLesson) {
            return response()->json(['available' => false, 'message' => 'Deze tijd is al geboekt door een andere leerling.']);
        }

        return response()->json(['available' => true]);
    }

    public function index()
    {
        $user = Auth::user();

        $lessen = Les::where('leerling_id', $user->id)
            ->orWhere('instructeur_id', $user->id)
            ->with(['leerling', 'instructeur', 'voertuig'])
            ->get();

        $instructeurs = Instructeur::all();

        // Generate current week's days dynamically
        $startOfWeek = now()->startOfWeek();
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = $startOfWeek->copy()->addDays($i)->format('Y-m-d');
        }

        // Get available lesson slots based on beschikbaarheden
        $beschikbaarheden = Beschikbaarheid::with('instructeur', 'voertuig')
            ->whereIn('datum', $weekDays)
            ->get();

        // Extract unique available time slots from beschikbaarheden
        $timeSlots = $beschikbaarheden->pluck('begin_tijd')->unique()->sort()->values()->all();

        // Fetch all existing bookings (including old ones)
        $bookedLessons = Les::whereIn('datum', $weekDays)->get();

        // Mark booked slots
        $slots = [];
        foreach ($beschikbaarheden as $beschikbaarheid) {
            $isBooked = Les::where('instructeur_id', $beschikbaarheid->instructeur_id)
                ->where('datum', $beschikbaarheid->datum)
                ->where(function ($query) use ($beschikbaarheid) {
                    $query->whereBetween('begin_tijd', [$beschikbaarheid->begin_tijd, $beschikbaarheid->eind_tijd])
                        ->orWhereBetween('eind_tijd', [$beschikbaarheid->begin_tijd, $beschikbaarheid->eind_tijd]);
                })
                ->exists();

            $slots[] = [
                'date' => $beschikbaarheid->datum,
                'time' => $beschikbaarheid->begin_tijd,
                'instructor' => $beschikbaarheid->instructeur->naam ?? 'Onbekend',
                'status' => $isBooked ? 'geboekt' : 'beschikbaar',
                'booked' => $isBooked
            ];
        }

        return view('lessen.index', compact('lessen', 'instructeurs', 'weekDays', 'slots', 'beschikbaarheden', 'bookedLessons'));

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
            'eind_tijd' => 'required|date_format:H:i|after:begin_tijd',
            'instructeur_id' => 'required|exists:instructeurs,id',
            'leerling_id' => 'required|exists:leerling,id',
            'voertuig_id' => 'nullable|exists:voertuigen,id',
        ]);

        // Check if instructor has beschikbaarheid at this time
        $beschikbaarheid = Beschikbaarheid::where('instructeur_id', $validated['instructeur_id'])
            ->where('datum', $validated['datum'])
            ->where('begin_tijd', '<=', $validated['begin_tijd'])
            ->where('eind_tijd', '>=', $validated['eind_tijd'])
            ->first();

        if (!$beschikbaarheid) {
            return back()->withErrors(['error' => 'De instructeur is niet beschikbaar op dit moment.']);
        }

        // Prevent double booking
        $existingLesson = Les::where('instructeur_id', $validated['instructeur_id'])
            ->where('datum', $validated['datum'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('begin_tijd', [$validated['begin_tijd'], $validated['eind_tijd']])
                    ->orWhereBetween('eind_tijd', [$validated['begin_tijd'], $validated['eind_tijd']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('begin_tijd', '<=', $validated['begin_tijd'])
                            ->where('eind_tijd', '>=', $validated['eind_tijd']);
                    });
            })
            ->first();

        if ($existingLesson) {
            return back()->withErrors(['error' => 'Deze tijd is al geboekt door een andere leerling.']);
        }

        // Create the lesson if everything is valid
        $les = Les::create($validated);

        // Send confirmation email if the leerling exists
        if ($les->leerling) {
            Mail::to($les->leerling->email)->send(new LessonNotification($les, 'created'));
        }

        if ($request->has('send_email') && $les->leerling) {
            Mail::to($les->leerling->email)->send(new LessonNotification($les, 'created'));
        }

        return redirect()->route('lessen.index')->with('success', 'Les succesvol geboekt!');
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
