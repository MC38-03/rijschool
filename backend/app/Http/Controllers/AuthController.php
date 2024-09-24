<?php

namespace App\Http\Controllers;

use App\Models\Leerling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'gebruikersnaam' => 'required|string|max:255|unique:leerling',
            'naam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'leeftijd' => 'required|integer|min:16',
            'email' => 'required|string|email|max:255|unique:leerling',
            'wachtwoord' => 'required|string|min:8|confirmed',
        ]);

        $leerling = Leerling::create([
            'gebruikersnaam' => $request->gebruikersnaam,
            'naam' => $request->naam,
            'achternaam' => $request->achternaam,
            'leeftijd' => $request->leeftijd,
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
        $request->validate([
            'gebruikersnaam' => 'required|string',
            'wachtwoord' => 'required|string',
        ]);

        $leerling = Leerling::where('gebruikersnaam', $request->gebruikersnaam)->first();

        if (! $leerling || ! Hash::check($request->wachtwoord, $leerling->wachtwoord)) {
            throw ValidationException::withMessages([
                'gebruikersnaam' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $leerling->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], 200)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->header('Access-Control-Allow-Credentials', 'true');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
