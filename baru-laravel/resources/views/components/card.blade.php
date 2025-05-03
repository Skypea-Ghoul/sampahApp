@props(['bin'])
@php
    if ($bin->weight >= 15) {
        $status      = 'Penuh';
        $statusColor = 'bg-red-100 text-red-700';
    } elseif ($bin->weight >= 5) {
        $status      = 'Setengah penuh';
        $statusColor = 'bg-yellow-100 text-yellow-700';
    } else {
        $status      = 'Kosong';
        $statusColor = 'bg-green-100 text-green-700';
    }
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow p-4 cursor-pointer hover:shadow-lg transition']) }}
     @click="$dispatch('bin-selected', {
       id: {{ $bin->id }},
       lat: {{ $bin->latitude }},
       lng: {{ $bin->longitude }},
       status: '{{ $status }}',
       weight: '{{ number_format($bin->weight,1) }}',
       distance: '{{ number_format($bin->distance) }}'
     })"
>
    <h2 class="text-lg font-semibold mb-2">Bin #{{ $bin->id }}</h2>
    <div class="flex items-center mb-2 space-x-2">
      <span class="font-medium">Berat:</span>
      <span>{{ number_format($bin->weight, 1) }} kg</span>
    </div>
    <div class="flex items-center mb-2 space-x-2">
      <span class="font-medium">Jarak:</span>
      <span>{{ number_format($bin->distance) }} m</span>
    </div>
    <span class="inline-block px-2 py-0.5 rounded-full font-semibold {{ $statusColor }}">
      {{ $status }}
    </span>
    
</div>
