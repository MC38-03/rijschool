<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestDriveRequestMail;

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
    

        Mail::to('snipekingc38@gmail.com')
            ->send(new TestDriveRequestMail($validatedData));
    
        return response()->json(['message' => 'Email succesvol verzonden!'], 200);
    }
    
}
