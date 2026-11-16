<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Le formulaire de contact s'affiche en bas de la page d'accueil :
     * sans JavaScript, on y revient directement.
     */
    protected $redirect = '/#contact';

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Merci d’indiquer votre nom.',
            'name.min' => 'Votre nom doit contenir au moins :min caractères.',
            'name.max' => 'Votre nom ne peut pas dépasser :max caractères.',
            'email.required' => 'Merci d’indiquer votre adresse e-mail.',
            'email.email' => 'Cette adresse e-mail ne semble pas valide.',
            'email.max' => 'Votre adresse e-mail est trop longue.',
            'message.required' => 'Merci d’écrire votre message.',
            'message.min' => 'Votre message doit contenir au moins :min caractères.',
            'message.max' => 'Votre message ne peut pas dépasser :max caractères.',
            '*.string' => 'Ce champ est invalide.',
        ];
    }

    /**
     * Champ piège invisible : seuls les robots le remplissent.
     */
    public function isSpam(): bool
    {
        return filled($this->input('website'));
    }
}
