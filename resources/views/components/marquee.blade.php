@props(['text', 'duration' => '40s', 'repeat' => 6])
{{-- Bandeau décoratif : le texte est masqué aux lecteurs d'écran, le contenu est dupliqué pour une boucle fluide. --}}
<div {{ $attributes->class('marquee overflow-hidden border-b-2 border-black') }}>
    <div class="marquee-track flex w-max" style="--marquee-duration: {{ $duration }}" aria-hidden="true">
        @foreach (range(1, 2) as $copy)
            <div class="flex shrink-0 items-center gap-12 py-4 pr-12">
                @foreach (range(1, $repeat) as $i)
                    <span class="flex items-center gap-3 font-display text-xl font-bold whitespace-nowrap">{{ $text }}</span>
                @endforeach
            </div>
        @endforeach
    </div>
    {{ $slot }}
</div>
