@php
    $links = [
        'a-propos' => 'À propos',
        'services' => 'Services',
        'competences' => 'Compétences',
        'parcours' => 'Parcours',
    ];
    $base = request()->routeIs('home') ? '' : route('home');
@endphp
@foreach ($links as $anchor => $label)
    <a href="{{ $base }}#{{ $anchor }}" class="{{ $linkClass }}">{{ $label }}</a>
@endforeach
<a href="{{ $base }}#contact" class="{{ $ctaClass }}">Me contacter</a>
