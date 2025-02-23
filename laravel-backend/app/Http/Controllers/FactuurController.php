<?php

namespace App\Http\Controllers;

use App\Models\Factuur;
use App\Models\User;
use App\Models\Instructeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Builder\Builder;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FactuurController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch facturen specific to the logged-in user
        $facturen = Factuur::where('leerling_id', $user->id)
            ->orWhere('instructeur_id', $user->id)
            ->get();

        // Generate QR codes for unpaid invoices
        foreach ($facturen as $factuur) {
            if ($factuur->status !== 'Betaald') {
                $factuur->qr_code = Builder::create()
                    ->data(route('facturen.pay', $factuur->id))
                    ->size(150)
                    ->margin(10)
                    ->build()
                    ->getDataUri();
            }
        }

        return view('facturen.index', compact('facturen'));
    }

    public function showPayment($id)
    {
        $factuur = Factuur::findOrFail($id);

        // Generate a QR code for the payment link
        $qrCode = Builder::create()
            ->data(route('facturen.confirm', $factuur->id)) // QR code redirects to payment confirmation
            ->size(200)
            ->margin(10)
            ->build()
            ->getDataUri();

        return view('facturen.payment', compact('factuur', 'qrCode'));
    }


    public function confirmPayment($id)
    {
        $factuur = Factuur::findOrFail($id);
        $factuur->status = 'Betaald';
        $factuur->save();

        return redirect()->route('facturen.index')->with('payment_success', 'De betaling is succesvol voltooid.');
    }


    public function pay($id)
    {
        $factuur = Factuur::findOrFail($id);

        // Mark as paid
        $factuur->status = 'Betaald';
        $factuur->save();

        return redirect()->route('facturen.index')->with('success', 'Factuur succesvol betaald!');
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
