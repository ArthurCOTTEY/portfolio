<?php

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

beforeEach(fn () => Mail::fake());

$valid = ['name' => 'Jeanne Dupont', 'email' => 'jeanne@example.com', 'message' => 'Bonjour, j’ai un projet à vous proposer.'];

it('envoie le message par e-mail', function () use ($valid) {
    $this->postJson('/contact', $valid)->assertOk()->assertJsonStructure(['message']);

    Mail::assertSent(ContactMessage::class, fn (ContactMessage $mail) => $mail->hasTo(config('site.email'))
        && $mail->hasReplyTo('jeanne@example.com')
        && $mail->body === $valid['message']);
});

it('valide les champs avec des messages en français', function () {
    $this->postJson('/contact', ['email' => 'pas-un-email'])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name', 'email', 'message'])
        ->assertJsonPath('errors.email.0', 'Cette adresse e-mail ne semble pas valide.');

    Mail::assertNothingSent();
});

it('ignore silencieusement les robots (honeypot)', function () use ($valid) {
    $this->postJson('/contact', [...$valid, 'website' => 'spam.example'])->assertOk();

    Mail::assertNothingSent();
});

it('limite le nombre d’envois', function () use ($valid) {
    foreach (range(1, 5) as $i) {
        $this->postJson('/contact', $valid)->assertOk();
    }

    $this->postJson('/contact', $valid)->assertTooManyRequests();
});

it('fonctionne sans JavaScript (redirection avec message)', function () use ($valid) {
    $this->post('/contact', $valid)
        ->assertRedirect(route('home').'#contact')
        ->assertSessionHas('contact.success');
});

it('affiche le contenu de l’e-mail', function () use ($valid) {
    $html = (new ContactMessage($valid['name'], $valid['email'], $valid['message']))->render();

    expect($html)->toContain('Jeanne Dupont')->toContain('jeanne@example.com')->toContain('projet à vous proposer');
});
