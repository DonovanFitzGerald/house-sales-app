@php
$badgeFor = static function (string $rating): string {
    return match ($rating) {
        'A1','A2','A3'       => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'B1','B2','B3'       => 'bg-lime-100 text-lime-700 ring-lime-200',
        'C1','C2','C3'       => 'bg-yellow-100 text-yellow-700 ring-yellow-200',
        'D1','D2'            => 'bg-amber-100 text-amber-700 ring-amber-200',
        'E1','E2','F','G'    => 'bg-red-100 text-red-700 ring-red-200',
        default              => 'bg-gray-100 text-gray-700 ring-gray-200',
    };
};

$img = $house->featured_image_url ?? asset('storage/houses/'.$house->featured_image.'.jpg');

$address = trim(collect([
    $house->address_line_1,
    $house->address_line_2,
    $house->city,
    $house->county,
    $house->zip,
])->filter()->implode(', '));

$prettyType = \Illuminate\Support\Str::headline(str_replace('detatched', 'detached', $house->house_type));
@endphp

<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-6">
        <div class="mb-4 flex items-center gap-3">
            <a href="{{ route('houses.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m15 19-7-7 7-7"/></svg>
                Back
            </a>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="relative aspect-[16/10] w-full overflow-hidden rounded-t-2xl bg-gray-100">
                <img src="{{ $img }}" alt="{{ $address }}" class="h-full w-full object-cover">
                <div class="absolute top-3 left-3 flex items-center gap-2">
                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">BER {{ $house->energy_rating }}</span>
                    <span class="inline-flex items-center rounded-full bg-white/90 px-2.5 py-1 text-xs font-medium text-gray-700 ring-1 ring-gray-200 backdrop-blur">{{ $prettyType }}</span>
                </div>
            </div>

            <div class="p-5 sm:p-7">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $address }}</h1>
                <div class="mt-2 flex flex-wrap items-center gap-4 text-sm text-gray-700">
                    <div class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10.5L12 4l9 6.5v7.5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7.5Z"/><path d="M9 20v-6h6v6"/></svg>
                        <span>{{ $house->beds }} beds</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10h18M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M3 10v7h18v-7M7 17v-2m10 2v-2"/></svg>
                        <span>{{ $house->baths }} baths</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 4h16v16H4z"/><path d="M8 8h8v8H8z"/></svg>
                        <span>{{ number_format($house->square_metres) }} m²</span>
                    </div>
                </div>

                <p class="mt-5 text-gray-700 leading-relaxed">{{ $house->description }}</p>

                <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="rounded-xl border border-gray-200 p-4">
                        <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-gray-500">Address</h2>
                        <div class="text-gray-800">
                            <div>{{ $house->address_line_1 }}</div>
                            @if($house->address_line_2)<div>{{ $house->address_line_2 }}</div>@endif
                            <div>{{ $house->city }}, {{ $house->county }}</div>
                            <div>{{ $house->zip }}</div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 p-4">
                        <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-gray-500">Details</h2>
                        <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-gray-800">
                            <dt class="text-gray-500">ID</dt><dd>{{ $house->id }}</dd>
                            <dt class="text-gray-500">Type</dt><dd>{{ $prettyType }}</dd>
                            <dt class="text-gray-500">Energy</dt><dd>BER {{ $house->energy_rating }}</dd>
                            <dt class="text-gray-500">Area</dt><dd>{{ number_format($house->square_metres) }} m²</dd>
                            <dt class="text-gray-500">Beds</dt><dd>{{ $house->beds }}</dd>
                            <dt class="text-gray-500">Baths</dt><dd>{{ $house->baths }}</dd>
                            <dt class="text-gray-500">Created</dt><dd>{{ $house->created_at?->format('Y-m-d H:i') }}</dd>
                            <dt class="text-gray-500">Updated</dt><dd>{{ $house->updated_at?->format('Y-m-d H:i') }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('houses.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Browse more
                    </a>
                    <a href="{{ route('houses.show', $house) }}" class="inline-flex items-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        View photos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
