<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:5',
        ], [
            'name.required' => __('form.validation.name_required'),
            'name.min' => __('form.validation.name_min'),

            'email.required' => __('form.validation.email_required'),
            'email.email' => __('form.validation.email_email'),

            'message.required' => __('form.validation.message_required'),
            'message.min' => __('form.validation.message_min'),
        ]);

        Mail::raw(
            "Nom: {$validated['name']}\nEmail: {$validated['email']}\nMessage:\n{$validated['message']}",
            function ($message) use ($validated) {
                $message->to('arthur.cottey1@gmail.com')
                    ->subject('Contact site')
                    ->replyTo($validated['email']);
            }
        );

        return response()->json([
            'success' => true,
            'message' => __('form.contact_section.success')
        ]);
    }
}
