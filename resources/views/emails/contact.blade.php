<x-mail::message>
# Nouveau message depuis le portfolio

**Nom :** {{ $name }}
**E-mail :** {{ $email }}

<x-mail::panel>
{!! nl2br(e($body)) !!}
</x-mail::panel>

Répondez directement à cet e-mail pour écrire à {{ $name }}.
</x-mail::message>
