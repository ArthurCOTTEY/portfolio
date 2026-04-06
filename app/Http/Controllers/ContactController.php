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
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 2 caractères.',

            'email.required' => 'L’email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',

            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 5 caractères.',
        ]);

        Mail::to('arthur.cottey1@gmail.com')->send(new ContactMail($validated));

        return response()->json([
            'success' => true,
            'message' => 'Message envoyé avec succès !'
        ]);
    }
}
