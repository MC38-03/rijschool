<?php

namespace App\Http\Controllers;

use App\Models\Leerling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation with minimum age check
        $request->validate([
            'gebruikersnaam' => 'required|string|max:255|unique:leerling',
            'naam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'geboortedatum' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minimumAge = Carbon::now()->subYears(16)->subMonths(6);
                    if (Carbon::parse($value)->greaterThan($minimumAge)) {
                        $fail('You must be at least 16.5 years old to register.');
                    }
                },
            ],
            'email' => 'required|string|email|max:255|unique:leerling',
            'wachtwoord' => 'required|string|min:8|confirmed',
        ]);

        // Create new student (leerling)
        $leerling = Leerling::create([
            'gebruikersnaam' => $request->gebruikersnaam,
            'naam' => $request->naam,
            'achternaam' => $request->achternaam,
            'geboortedatum' => $request->geboortedatum,
            'email' => $request->email,
            'wachtwoord' => Hash::make($request->wachtwoord),
        ]);

        return response()->json(['message' => 'Registration successful'], 201)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->header('Access-Control-Allow-Credentials', 'true');
    }

    public function login(Request $request)
    {
        // Validate login input
        $validatedData = $request->validate([
            'gebruikersnaam' => 'required|string',
            'wachtwoord' => 'required|string',
        ]);

        $leerling = Leerling::where('gebruikersnaam', $validatedData['gebruikersnaam'])->first();

        if (!$leerling || !Hash::check($validatedData['wachtwoord'], $leerling->wachtwoord)) {
            throw ValidationException::withMessages([
                'gebruikersnaam' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $leerling->tokens()->where('name', 'auth-token')->first();
        if (!$token) {
            // Create a new token if none exists
            $token = $leerling->createToken('auth-token')->plainTextToken;
        }

        return response()->json([
            'token' => $token,
            'user' => [
                'gebruikersnaam' => $leerling->gebruikersnaam,
                'naam' => $leerling->naam,
                'achternaam' => $leerling->achternaam,
                'geboortedatum' => $leerling->geboortedatum,
                'email' => $leerling->email
            ]
        ], 200)
        ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
        ->header('Access-Control-Allow-Credentials', 'true');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
    
        if ($user) {
            $user->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout successful'], 200)
                ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
                ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->header('Access-Control-Allow-Credentials', 'true');
        }
    
        return response()->json(['message' => 'Unauthenticated'], 401)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
