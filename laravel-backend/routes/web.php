<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leerling; // Assuming you have a Leerling model


Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'gebruikersnaam' => ['required', 'string'],
        'wachtwoord' => ['required', 'string'],
    ]);

    // Check if the authentication works
    if (Auth::attempt([
        'gebruikersnaam' => $credentials['gebruikersnaam'],
        'password' => $credentials['wachtwoord'], 
    ])) {
        // Regenerate session to avoid fixation attacks
        $request->session()->regenerate();

        // Send success response
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

Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Assuming this is the dashboard view
    })->name('dashboard');
});

// Catch-all route to handle Vue routes for your SPA
Route::get('/{any}', function () {
    return view('app');  // Make sure 'app.blade.php' is the entry point for your Vue app
})->where('any', '.*');

