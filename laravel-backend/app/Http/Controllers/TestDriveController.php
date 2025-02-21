<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestDriveRequestMail;
use App\Mail\TestDriveConfirmationMail;

class TestDriveController extends Controller
{
    public function sendRequestEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        try {
            // Send email to the admin (driving school)
            Mail::to('snipekingc38@gmail.com')
                ->send(new TestDriveRequestMail($validatedData));

            // Send a confirmation email to the user
            Mail::to($validatedData['email'])
                ->send(new TestDriveConfirmationMail($validatedData));

            return response()->json(['message' => 'E-mail succesvol verzonden!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Fout bij het verzenden van de e-mail: ' . $e->getMessage()], 500);
        }
    }
}

