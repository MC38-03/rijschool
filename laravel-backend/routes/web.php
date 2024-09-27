<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\InstructeurController;
use App\Http\Controllers\LeerlingController;
use App\Http\Controllers\LesController;
use App\Http\Controllers\VoertuigController;
use App\Http\Controllers\FactuurController;
use App\Http\Controllers\BeschikbaarheidController;

// Authentication routes (login, register, logout)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'gebruikersnaam' => ['required', 'string'],
        'wachtwoord' => ['required', 'string'],
    ]);

    if (Auth::attempt([
            'gebruikersnaam' => $credentials['gebruikersnaam'],
            'password' => $credentials['wachtwoord'],
        ])) {
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'redirect' => '/dashboard',
            'user' => Auth::user(),
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Login failed. Invalid credentials.',
    ], 401);
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'gebruikersnaam' => ['required', 'string', 'max:255'],
        'naam' => ['required', 'string', 'max:255'],
        'achternaam' => ['required', 'string', 'max:255'],
        'geboortedatum' => ['required', 'date'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'wachtwoord' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'gebruikersnaam' => $data['gebruikersnaam'],
        'naam' => $data['naam'],
        'achternaam' => $data['achternaam'],
        'geboortedatum' => $data['geboortedatum'],
        'email' => $data['email'],
        'wachtwoord' => bcrypt($data['wachtwoord']),
    ]);

    Auth::login($user);

    return response()->json([
        'success' => true,
        'redirect' => '/dashboard',
        'user' => $user,
    ]);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json([
        'success' => true,
        'message' => 'Successfully logged out',
        'redirect' => '/login',
    ]);
});

// Middleware to ensure users are authenticated
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Define resourceful routes for CRUD operations (this will automatically handle create, edit, etc.)
Route::resource('beschikbaarheden', BeschikbaarheidController::class);
Route::resource('leerlingen', LeerlingController::class);
Route::resource('lessen', LesController::class);
Route::resource('voertuigen', VoertuigController::class);
Route::resource('facturen', FactuurController::class);
Route::resource('instructeurs', InstructeurController::class);

// Catch-all route for Vue.js SPA
Route::get('/{any}', function () {
    return view('app'); // The entry point for your Vue.js app
})->where('any', '^(?!admin|beschikbaarheden|leerlingen|lessen|voertuigen|facturen|instructeurs).*$');

    