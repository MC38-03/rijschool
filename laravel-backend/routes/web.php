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
use App\Http\Controllers\TestDriveController;


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

Route::get('/dashboard', function () {
    return view('app');
})->where('any', '.*');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/leerlingen', [LeerlingController::class, 'index'])->name('leerlingen.index');
});


Route::resource('beschikbaarheden', BeschikbaarheidController::class);
Route::resource('leerlingen', LeerlingController::class);
Route::resource('lessen', LesController::class);
Route::resource('voertuigen', VoertuigController::class);
Route::resource('instructeurs', InstructeurController::class);
Route::resource('facturen', FactuurController::class);

Route::middleware('auth')->group(function () {
    Route::get('/student/schedule', [LesController::class, 'studentSchedule'])->name('student.schedule');
});

Route::post('/send-test-drive-email', [TestDriveController::class, 'sendRequestEmail']);


Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!admin|beschikbaarheden|leerlingen|lessen|voertuigen|facturen|instructeurs).*$');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*'); 