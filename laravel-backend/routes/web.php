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

// 🔐 Authentication routes (login, register, logout)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'gebruikersnaam' => ['required', 'string'],
        'wachtwoord' => ['required', 'string'],
    ]);

    if (
        Auth::attempt([
            'gebruikersnaam' => $credentials['gebruikersnaam'],
            'password' => $credentials['wachtwoord'],
        ])
    ) {
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

// 📋 Dashboard route
Route::get('/dashboard', function () {
    return view('app');
})->where('any', '.*');

// 🔒 Admin-only routes for managing users
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/leerlingen', [LeerlingController::class, 'index'])->name('leerlingen.index');
});

// 📅 Resource routes for availability, lessons, vehicles, instructors
Route::resource('beschikbaarheden', BeschikbaarheidController::class);
Route::resource('leerlingen', LeerlingController::class);
Route::resource('lessen', LesController::class);
Route::resource('voertuigen', VoertuigController::class);
Route::resource('instructeurs', InstructeurController::class);
Route::resource('facturen', FactuurController::class);

// 🔐 Authenticated student-specific routes
Route::middleware('auth')->group(function () {
    Route::get('/student/schedule', [LesController::class, 'studentSchedule'])->name('student.schedule');
});

// 📧 Sending test drive email
Route::post('/send-test-drive-email', [TestDriveController::class, 'sendRequestEmail']);

// 💳 Payment routes (Laravel handles these before Vue Router!)
Route::get('/facturen/{id}/payment', [FactuurController::class, 'showPayment'])->name('facturen.payment');
Route::post('/facturen/{id}/confirm', [FactuurController::class, 'confirmPayment'])->name('facturen.confirm');
Route::post('/facturen/{id}/pay', [FactuurController::class, 'pay'])->name('facturen.pay');

// 🧾 Facturen (Invoice) routes
Route::middleware('auth')->group(function () {
    Route::get('/facturen', [FactuurController::class, 'index'])->name('facturen.index');
});

// 🚗 API route for fetching instructor vehicles
Route::get('/api/instructor-vehicles/{id}', function ($id) {
    $voertuigen = App\Models\Beschikbaarheid::where('instructeur_id', $id)
        ->with('voertuig')
        ->get()
        ->pluck('voertuig')
        ->unique('id')
        ->values();
    return response()->json($voertuigen);
});

// 💼 Create availability route
Route::post('/beschikbaarheden/store', [BeschikbaarheidController::class, 'store'])->name('beschikbaarheden.store');

// 🔄 Lesson availability checker
Route::post('/lessen/check-availability', [App\Http\Controllers\LesController::class, 'checkAvailability'])->name('lessen.checkAvailability');

// 🔁 Vue Router fallback route (only if nothing else matches)
// This should be LAST!
Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!admin|beschikbaarheden|leerlingen|lessen|voertuigen|facturen|instructeurs).*$');
