@props(['house'])

@php
    $badgeFor = static function (string $rating): string {
        return match ($rating) {
            'A1', 'A2', 'A3' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
            'B1', 'B2', 'B3' => 'bg-lime-100 text-lime-700 ring-lime-200',
            'C1', 'C2', 'C3' => 'bg-yellow-100 text-yellow-700 ring-yellow-200',
            'D1', 'D2' => 'bg-amber-100 text-amber-700 ring-amber-200',
            'E1', 'E2', 'F', 'G' => 'bg-red-100 text-red-700 ring-red-200',
            default => 'bg-gray-100 text-gray-700 ring-gray-200',
        };
    };

    $img = $house->featured_image_url ?? asset('images/houses/' . $house->featured_image);
    $address = trim(collect([$house->address_line_1, $house->address_line_2, $house->city, $house->county, $house->zip])->filter()->implode(', '));
    $prettyType = \Illuminate\Support\Str::headline(str_replace('detatched', 'detached', $house->house_type));
@endphp

<section class="mx-auto max-w-7xl px-4 py-6">
    <nav class="mb-4 text-sm text-gray-500">
        <a href="{{ route('houses.index') }}" class="hover:text-gray-700">Houses</a>
        <span class="mx-2">/</span>
        <a href="{{ route('houses.index', ['q' => $prettyType]) }}" class="text-gray-900">{{ $prettyType }}</a>
    </nav>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="relative aspect-[16/9] w-full overflow-hidden rounded-t-2xl bg-gray-100">
            <img src="{{ $img }}" alt="{{ $address }}" class="h-full w-full object-cover">
            <div
                class="absolute inset-x-0 bottom-0 flex flex-wrap items-center gap-2 bg-gradient-to-t from-black/50 to-transparent p-4">
                <span
                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">
                    BER {{ $house->energy_rating }}
                </span>
                <span
                    class="inline-flex items-center rounded-full bg-white/95 px-2.5 py-1 text-xs font-medium text-gray-700 ring-1 ring-gray-200">
                    {{ $prettyType }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 p-6 lg:grid-cols-2 lg:p-8">
            <div class="lg:col-span-2">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $address }}</h1>

                <div class="mt-3 flex flex-wrap items-center gap-4 text-sm text-gray-700">
                    <div class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M3 10.5L12 4l9 6.5v7.5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7.5Z" />
                            <path d="M9 20v-6h6v6" />
                        </svg>
                        <span>{{ $house->beds }} beds</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M3 10h18M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M3 10v7h18v-7M7 17v-2m10 2v-2" />
                        </svg>
                        <span>{{ $house->baths }} baths</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M4 4h16v16H4z" />
                            <path d="M8 8h8v8H8z" />
                        </svg>
                        <span>{{ number_format($house->square_metres) }} m²</span>
                    </div>
                </div>

                <div class="mt-6 space-y-6">
                    <section>
                        <h2 class="text-base font-semibold text-gray-900">Overview</h2>
                        <p class="mt-2 leading-relaxed text-gray-700">{{ $house->description }}</p>
                    </section>

                    <section class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="rounded-xl border border-gray-200 p-4">
                            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-gray-500">Address</h3>
                            <div class="text-gray-800">
                                <div>{{ $house->address_line_1 }}</div>
                                @if($house->address_line_2)
                                <div>{{ $house->address_line_2 }}</div>@endif
                                <div>{{ $house->city }}, {{ $house->county }}</div>
                                <div>{{ $house->zip }}</div>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-gray-200 p-5 shadow-sm">
                            <h3 class="text-base font-semibold text-gray-900">Details</h3>
                            <ul class="mt-4 space-y-3 text-sm text-gray-700">
                                <li class="flex items-center justify-between">
                                    <span>Property type</span><span
                                        class="font-medium text-gray-900">{{ $prettyType }}</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span>Area</span><span
                                        class="font-medium text-gray-900">{{ number_format($house->square_metres) }}
                                        m²</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span>Bedrooms</span><span
                                        class="font-medium text-gray-900">{{ $house->beds }}</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span>Bathrooms</span><span
                                        class="font-medium text-gray-900">{{ $house->baths }}</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span>Energy rating</span>
                                    <span
                                        class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">BER
                                        {{ $house->energy_rating }}</span>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <div class="mt-5 grid grid-cols-4 gap-2">
                        <a href="{{ route('houses.index') }}"
                            class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Backto list
                        </a>
                        <a href="{{ route('houses.show', $house) }}"
                            class="inline-flex flex-1 items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            Contact
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <button onmousedown=openModal()
                                class="inline-flex flex-1 items-center justify-center rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-gray-400 cursor-pointer">
                                Edit
                            </button>
                            <a href="{{ route('houses.destroy', $house) }}"
                                class="inline-flex flex-1 items-center justify-center rounded-lg bg-red-700 px-4 py-2 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                Delete
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-modal" style="visibility: hidden"
        class="shadow-md p-5 rounded-2xl fixed w-2/3 top-1/2 left-1/2 -translate-1/2 bg-white ">
        <x-house-form action="{{ route('houses.update', $house) }}" method="PUT" :house="$house" />
    </div>

    <script>
        const openModal = () =>
        {
            const modal = document.querySelector('#edit-modal');
            const modalVisibility = document.querySelector('#edit-modal').style.visibility;
            modal.style.visibility = modalVisibility === "visible" ? "hidden" : "visible";
        }
    </script>
</section>