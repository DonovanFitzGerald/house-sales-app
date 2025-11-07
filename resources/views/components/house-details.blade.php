@props(['house', 'topBid'])

@php
// BER badge → Tailwind styles
$badgeFor = static function (?string $rating): string {
$rating = strtoupper((string) $rating);
return match ($rating) {
'A1','A2','A3' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
'B1','B2','B3' => 'bg-lime-100 text-lime-700 ring-lime-200',
'C1','C2','C3' => 'bg-yellow-100 text-yellow-700 ring-yellow-200',
'D1','D2' => 'bg-amber-100 text-amber-700 ring-amber-200',
'E1','E2','F','G' => 'bg-red-100 text-red-700 ring-red-200',
default => 'bg-gray-100 text-gray-700 ring-gray-200',
};
};

$img = $house->featured_image_url ?? asset('images/houses/' . $house->featured_image);
$address = trim(collect([$house->address_line_1, $house->address_line_2, $house->city, $house->county,
$house->zip])->filter()->implode(', '));

$bidder = $topBid?->user;
$avatar = $bidder?->featured_image_url
?? ($bidder?->featured_image ? asset('images/users/'.$bidder->featured_image) : asset('images/users/default.jpg'));
@endphp

<section aria-labelledby="house-title" class="mx-auto max-w-6xl">
    {{-- Breadcrumbs --}}
    <nav class="mb-4 text-sm" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-2 text-gray-500">
            <li>
                <a href="{{ route('houses.index') }}" class="hover:text-gray-700">Houses</a>
            </li>
            <li aria-hidden="true" class="text-gray-400">/</li>
            <li>
                <a href="{{ route('houses.index', ['q' => $house->house_type]) }}" class="text-gray-900">
                    {{ $house->house_type }}
                </a>
            </li>
        </ol>
    </nav>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        {{-- Hero / badges --}}
        <div class="relative">
            <div class="aspect-[16/9] w-full bg-gray-100">
                <img src="{{ $img }}" alt="Exterior photo of {{ $address }}" class="h-full w-full object-cover"
                    loading="lazy" decoding="async" referrerpolicy="no-referrer">
            </div>
            <div
                class="absolute inset-x-0 bottom-0 flex flex-wrap items-center gap-2 bg-gradient-to-t from-black/60 to-transparent p-4">
                <span
                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">
                    <span class="sr-only">Energy rating: </span>BER {{ $house->energy_rating ?? '—' }}
                </span>
                <span
                    class="inline-flex items-center rounded-full bg-white/95 px-2.5 py-1 text-xs font-medium text-gray-700 ring-1 ring-gray-200">
                    {{ $house->house_type }}
                </span>
                @if($topBid)
                <span
                    class="ml-auto inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-gray-900 ring-1 ring-gray-200">
                    Top bid: €{{ number_format($topBid->value, 0) }}
                </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 p-6 lg:grid-cols-3 lg:p-8">
            {{-- Left: Title + quick facts + overview (2 cols) --}}
            <div class="lg:col-span-2">
                <h1 id="house-title" class="text-2xl font-semibold text-gray-900">{{ $address }}</h1>

                {{-- Quick facts --}}
                <dl class="mt-3 grid grid-cols-3 gap-3 text-sm text-gray-700 max-[420px]:grid-cols-2">
                    <div class="flex items-center gap-1.5">
                        {{-- Bed icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" aria-hidden="true" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M3 10.5L12 4l9 6.5v7.5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7.5Z" />
                            <path d="M9 20v-6h6v6" />
                        </svg>
                        <dt class="sr-only">Bedrooms</dt>
                        <dd>{{ $house->beds }} beds</dd>
                    </div>
                    <div class="flex items-center gap-1.5">
                        {{-- Bath icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" aria-hidden="true" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M3 10h18M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M3 10v7h18v-7M7 17v-2m10 2v-2" />
                        </svg>
                        <dt class="sr-only">Bathrooms</dt>
                        <dd>{{ $house->baths }} baths</dd>
                    </div>
                    <div class="flex items-center gap-1.5">
                        {{-- Area icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" aria-hidden="true" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M4 4h16v16H4z" />
                            <path d="M8 8h8v8H8z" />
                        </svg>
                        <dt class="sr-only">Floor area</dt>
                        <dd>{{ number_format($house->square_metres) }} m²</dd>
                    </div>
                </dl>

                {{-- Overview --}}
                <section class="mt-6">
                    <h2 class="text-base font-semibold text-gray-900">Overview</h2>
                    <p class="mt-2 leading-relaxed text-gray-700">{{ $house->description }}</p>
                </section>

                {{-- Address + Details --}}
                <section class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    {{-- Address (with microdata) --}}
                    <div class="rounded-xl border border-gray-200 p-4" itemscope
                        itemtype="https://schema.org/PostalAddress">
                        <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-gray-500">Address</h3>
                        <div class="text-gray-800">
                            <div itemprop="streetAddress">{{ $house->address_line_1 }}</div>
                            @if($house->address_line_2)
                            <div itemprop="streetAddress">{{ $house->address_line_2 }}</div>
                            @endif
                            <div><span itemprop="addressLocality">{{ $house->city }}</span>, <span
                                    itemprop="addressRegion">{{ $house->county }}</span></div>
                            <div itemprop="postalCode">{{ $house->zip }}</div>
                        </div>
                    </div>

                    {{-- Property facts --}}
                    <div class="rounded-xl border border-gray-200 p-4">
                        <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-gray-500">Details</h3>
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-center justify-between">
                                <span>Property type</span>
                                <span class="font-medium text-gray-900">{{ $house->house_type }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Area</span>
                                <span class="font-medium text-gray-900">{{ number_format($house->square_metres) }}
                                    m²</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Bedrooms</span>
                                <span class="font-medium text-gray-900">{{ $house->beds }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Bathrooms</span>
                                <span class="font-medium text-gray-900">{{ $house->baths }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Energy rating</span>
                                <span
                                    class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">
                                    BER {{ $house->energy_rating ?? '—' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </section>

                {{-- Actions --}}
                <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                    <a href="{{ route('houses.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-300">
                        Back to list
                    </a>
                    <a href="{{ route('houses.show', $house) }}"
                        class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-400">
                        Contact
                    </a>

                    {{-- Admin actions --}}
                    @if(auth()->user()?->role === 'admin')
                    <button type="button" onmousedown="openEditDialog()"
                        class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300">
                        Edit
                    </button>
                    <form action="{{ route('houses.destroy', $house) }}" method="POST" class="w-full"
                        onsubmit="return confirm('Are you sure you want to delete this house?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-red-700 px-4 py-2 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-300">
                            Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            {{-- Right: Top bid card --}}
            <div class="rounded-xl border border-gray-200 p-5 shadow-sm h-fit">
                <h2 id="top-bid-title" class="text-base font-semibold text-gray-900">Top bid</h2>

                @if($topBid)
                <dl class="mt-4 grid grid-cols-1 gap-3 ">
                    <p class="mt-1 font-semibold text-gray-900">€{{ number_format($topBid->value, 0) }}</p>
                </dl>

                <div class="mt-4 flex items-center gap-3">
                    <img src="{{ $avatar }}" alt="{{ $bidder?->name ? 'Avatar of '.$bidder->name : 'Bidder avatar' }}"
                        class="h-10 w-10 rounded-full object-cover ring-1 ring-gray-200" loading="lazy">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-gray-900">
                            {{ $bidder?->name ?? 'Anonymous bidder' }}
                        </p>
                    </div>
                </div>
                @else
                <p class="mt-4 text-sm text-gray-600">No bids yet.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Edit dialog (native <dialog> for better a11y) --}}
    @if(auth()->user()?->role === 'admin')
    <dialog id="editDialog" class="backdrop:bg-black/50 rounded-2xl p-0 w-[min(860px,90vw)]">
        <form method="dialog">
            <div class="flex items-center justify-between border-b border-gray-200 px-5 py-3">
                <h3 class="text-base font-semibold text-gray-900">Edit house</h3>
                <button class="rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700" aria-label="Close"
                    onclick="closeEditDialog()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path d="M6 6l12 12M6 18L18 6" />
                    </svg>
                </button>
            </div>
        </form>
        <div class="p-5">
            <x-house-form action="{{ route('houses.update', $house) }}" method="PUT" :house="$house" />
        </div>
    </dialog>
    <script>
    const dialogEl = document.getElementById('editDialog');

    function openEditDialog() {
        if (!dialogEl.open) {
            dialogEl.showModal();
        }
    }

    function closeEditDialog() {
        if (dialogEl.open) {
            dialogEl.close();
        }
    }
    </script>
    @endif
</section>