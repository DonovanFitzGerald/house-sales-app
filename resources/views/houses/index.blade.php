{{-- resources/views/houses/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Houses')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8">
    <div class="mb-6 flex items-center justify-between gap-4">
        <h1 class="text-2xl font-semibold">Houses</h1>
    </div>

    @if ($houses->count() === 0)
        <div class="rounded-xl border bg-white p-8 text-center text-gray-600">
            No houses found.
        </div>
    @else
        {{-- Grid of cards --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($houses as $house)
                <a href="{{ route('houses.show', $house) }}" class="group block overflow-hidden rounded-2xl border bg-white shadow-sm hover:shadow-md">
                    <div class="relative aspect-[4/3] w-full overflow-hidden bg-gray-100">
                        <img
                            src="{{ asset('storage/houses/'.$house->featured_image.'.jpg') }}"
                            onerror="this.src='https://placehold.co/800x600?text=House';"
                            alt="Photo of {{ $house->address_line_1 }}, {{ $house->city }}"
                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]"
                        >
                        {{-- BER badge --}}
                        @php
                            $badge = match($house->energy_rating) {
                                'A1','A2','A3' => 'bg-emerald-100 text-emerald-800 ring-emerald-200',
                                'B1','B2','B3' => 'bg-lime-100 text-lime-800 ring-lime-200',
                                'C1','C2','C3' => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
                                'D1','D2'      => 'bg-amber-100 text-amber-800 ring-amber-200',
                                'E1','E2'      => 'bg-orange-100 text-orange-800 ring-orange-200',
                                'F','G'        => 'bg-red-100 text-red-800 ring-red-200',
                                default        => 'bg-gray-100 text-gray-800 ring-gray-200',
                            };
                        @endphp
                        <span class="absolute left-3 top-3 rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 {{ $badge }}">
                            {{ $house->energy_rating }}
                        </span>
                    </div>

                    <div class="p-4">
                        <div class="mb-1 flex items-center justify-between gap-3">
                            <h2 class="line-clamp-1 text-base font-semibold">
                                {{ $house->address_line_1 }}
                            </h2>
                            <span class="shrink-0 text-xs capitalize text-gray-500">
                                {{ $house->house_type }}
                            </span>
                        </div>
                        <p class="line-clamp-1 text-sm text-gray-600">
                            {{ $house->city }}, {{ $house->county }} {{ $house->zip }}
                        </p>

                        <div class="mt-3 flex items-center gap-4 text-sm text-gray-700">
                            <span class="inline-flex items-center gap-1">
                                {{-- bed icon --}}
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v3h1a1 1 0 0 1 1 1v6h-2v-2H4v2H2v-6a1 1 0 0 1 1-1h1V7h2Zm2 0v3h8V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1Z"/></svg>
                                {{ $house->beds }} beds
                            </span>
                            <span class="inline-flex items-center gap-1">
                                {{-- bath icon --}}
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 3a3 3 0 0 1 3 3v3h9a1 1 0 1 1 0 2h-1v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3H3a1 1 0 1 1 0-2h1V6a3 3 0 0 1 3-3Zm0 2a1 1 0 0 0-1 1v3h4V6a1 1 0 0 0-1-1H7Z"/></svg>
                                {{ $house->baths }} baths
                            </span>
                            <span class="inline-flex items-center gap-1">
                                {{-- area icon --}}
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm0 2v14h14V5H5Z"/></svg>
                                {{ number_format($house->square_metres) }} m²
                            </span>
                        </div>

                        <p class="mt-3 line-clamp-2 text-sm text-gray-600">
                            {{ $house->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $houses->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
