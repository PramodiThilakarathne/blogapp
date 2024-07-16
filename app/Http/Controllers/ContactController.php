<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'messageContent' => $request->message,
        ];

        Mail::send('mail.contact', $data, function($message) use ($data) {
            $message->to('koralalagejayaneththi@gmail.com')
                    ->subject('New Message from ' . $data['name']);
        });

        return back()->with('success', 'Thank you for the feedback!');
    }
}
