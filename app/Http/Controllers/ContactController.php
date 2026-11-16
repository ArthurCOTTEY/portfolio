<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    private const SUCCESS = 'Merci, votre message a bien été envoyé. Je vous réponds au plus vite.';

    private const FAILURE = 'Votre message n’a pas pu être envoyé. Réessayez dans quelques instants ou écrivez-moi directement par e-mail.';

    public function __invoke(ContactRequest $request): JsonResponse|RedirectResponse
    {
        // On simule un succès pour ne pas renseigner les robots.
        if ($request->isSpam()) {
            return $this->respond($request, true, self::SUCCESS);
        }

        try {
            Mail::to(config('site.email'))->send(new ContactMessage(
                name: $request->validated('name'),
                email: $request->validated('email'),
                body: $request->validated('message'),
            ));
        } catch (Throwable $exception) {
            Log::error('Échec de l’envoi du formulaire de contact', ['exception' => $exception]);

            return $this->respond($request, false, self::FAILURE);
        }

        return $this->respond($request, true, self::SUCCESS);
    }

    private function respond(ContactRequest $request, bool $success, string $message): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], $success ? 200 : 500);
        }

        return redirect()
            ->to(route('home').'#contact')
            ->with($success ? 'contact.success' : 'contact.error', $message)
            ->withInput($success ? [] : $request->safe()->only(['name', 'email', 'message']));
    }
}
