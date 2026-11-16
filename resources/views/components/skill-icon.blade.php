@props(['skill'])
<li class="flex items-center gap-2 border-2 border-black bg-white py-1.5 pr-3 pl-1.5">
    @if ($skill->icon_data_uri)
        <img src="{{ $skill->icon_data_uri }}" alt="" width="28" height="28" decoding="async" class="h-7 w-7 object-contain">
    @else
        <span aria-hidden="true" class="flex h-7 w-7 items-center justify-center bg-black font-display text-xs font-bold text-white">
            {{ mb_strtoupper(mb_substr($skill->name, 0, 2)) }}
        </span>
    @endif
    <span class="text-sm font-medium">{{ $skill->name }}</span>
</li>
