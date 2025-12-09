@props(['house', 'bids', 'availableRealtors' => null])

@php
    // Case match tailwind styling for BER badge
    $badgeFor = static function (?string $rating): string {
        $rating = strtoupper((string) $rating);
        return match ($rating) {
            'A1', 'A2', 'A3' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'B1', 'B2', 'B3' => 'bg-lime-50 text-lime-700 ring-lime-200',
            'C1', 'C2', 'C3' => 'bg-amber-50 text-amber-700 ring-amber-200',
            'D1', 'D2' => 'bg-orange-50 text-orange-700 ring-orange-200',
            'E1', 'E2', 'F', 'G' => 'bg-red-50 text-red-700 ring-red-200',
            default => 'bg-gray-50 text-gray-700 ring-gray-200',
        };
    };

    // Format address and image asset
    $img = $house->featured_image_url ?? asset('images/houses/' . $house->featured_image);
    $address = trim(collect([
        $house->address_line_1,
        $house->address_line_2,
        $house->city,
        $house->county,
        $house->zip
    ])->filter()->implode(', '));

    // Get top bid and bidder
    $topBid = $bids[0] ?? null;
    $bidder = $topBid?->user;
    $avatar = $bidder?->featured_image_url
        ?? ($bidder?->featured_image ? asset('images/users/' . $bidder->featured_image) : asset('images/users/default.jpg'));

    // Check if user has admin options
    $hasAdminOptions = auth()->user()->role === 'admin'
        || in_array(auth()->id(), $house->realtors->pluck('id')->all());
@endphp

<section aria-labelledby="house-title" class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-0">
    <nav class="mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-1">
            <li>
                <a href="{{ route('houses.index') }}" class="transition-colors hover:text-gray-800">
                    Houses
                </a>
            </li>
            <li aria-hidden="true" class="px-1 text-gray-400">/</li>
            <li>
                <a href="{{ route('houses.index', ['q' => $house->house_type]) }}" class="font-medium text-gray-900">
                    {{ $house->house_type }}
                </a>
            </li>
        </ol>
    </nav>

    <div
        class="overflow-hidden rounded-3xl border border-gray-100 bg-white/90 shadow-lg shadow-gray-200/60 backdrop-blur-sm">
        <div class="relative">
            <div class="aspect-[16/9] w-full bg-gray-100">
                <img src="{{ $img }}" alt="Exterior photo of {{ $address }}" class="h-full w-full object-cover"
                    loading="lazy" decoding="async" referrerpolicy="no-referrer">
            </div>

            <div
                class="pointer-events-none absolute inset-x-0 bottom-0 flex flex-wrap items-center gap-2 bg-gradient-to-t from-black/60 via-black/10 to-transparent px-5 pb-4 pt-12">
                <span
                    class="pointer-events-auto inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">
                    <span class="mr-1 text-[11px] font-medium text-gray-500">BER</span>
                    {{ $house->energy_rating ?? '—' }}
                </span>

                <span
                    class="pointer-events-auto inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-gray-800 ring-1 ring-gray-200">
                    {{ $house->house_type }}
                </span>
            </div>
        </div>

        <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[minmax(0,2fr)_minmax(280px,1fr)]">
            <div class="space-y-8">
                <header class="space-y-3">
                    <h1 id="house-title" class="text-2xl font-semibold tracking-tight text-gray-900 sm:text-3xl">
                        {{ $address }}
                    </h1>

                    <dl class="grid grid-cols-3 gap-4 text-sm text-gray-700 max-[420px]:grid-cols-2">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path d="M3 10.5L12 4l9 6.5v7.5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7.5Z" />
                                <path d="M9 20v-6h6v6" />
                            </svg>
                            <dd class="font-medium">{{ $house->beds }} beds</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path
                                    d="M3 10h18M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M3 10v7h18v-7M7 17v-2m10 2v-2" />
                            </svg>
                            <dd class="font-medium">{{ $house->baths }} baths</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path d="M4 4h16v16H4z" />
                                <path d="M8 8h8v8H8z" />
                            </svg>
                            <dd class="font-medium">{{ number_format($house->square_metres) }} m²</dd>
                        </div>
                    </dl>
                </header>

                <section class="space-y-2">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-gray-500">Overview</h2>
                    <p class="text-sm leading-relaxed text-gray-700">
                        {{ $house->description }}
                    </p>
                </section>

                <section class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl border border-gray-100 bg-gray-50/80 p-4" itemscope
                        itemtype="https://schema.org/PostalAddress">
                        <h3 class="mb-3 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Address</h3>
                        <div class="space-y-0.5 text-sm text-gray-800">
                            <div itemprop="streetAddress">{{ $house->address_line_1 }}</div>
                            @if ($house->address_line_2)
                                <div itemprop="streetAddress">{{ $house->address_line_2 }}</div>
                            @endif
                            <div>
                                <span itemprop="addressLocality">{{ $house->city }}</span>,
                                <span itemprop="addressRegion">{{ $house->county }}</span>
                            </div>
                            <div itemprop="postalCode">{{ $house->zip }}</div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-white p-4">
                        <h3 class="mb-3 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Details</h3>
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
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $badgeFor($house->energy_rating) }}">
                                    BER {{ $house->energy_rating ?? '—' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </section>

                <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                    <a href="{{ route('houses.index') }}"
                        class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-800 shadow-sm transition hover:bg-gray-50">
                        Back to list
                    </a>

                    <a href="{{ route('houses.show', $house) }}"
                        class="inline-flex items-center justify-center rounded-full bg-gray-900 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-gray-800">
                        Contact
                    </a>

                    @if ($hasAdminOptions)
                        <button type="button" onclick="openEditModal()"
                            class="cursor-pointer inline-flex items-center justify-center rounded-full bg-amber-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-amber-600">
                            Edit
                        </button>

                        <a href="{{ route('houses.select-realtor', $house) }}"
                            class="cursor-pointer inline-flex items-center justify-center rounded-full bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                            Assign Realtor
                        </a>

                        <form action="{{ route('houses.destroy', $house) }}" method="POST" class="w-full"
                            onsubmit="return confirm('Are you sure you want to delete this house?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="cursor-pointer inline-flex w-full items-center justify-center rounded-full bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <aside class="flex flex-col gap-5">
                <p class="text-sm font-semibold text-gray-800">Top bid</p>
                <div class="flex flex-col gap-4 rounded-2xl border border-gray-100 bg-white/90 p-5 shadow-sm">
                    @if ($topBid && $bidder)
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $avatar }}"
                                alt="Avatar of bidder"
                                class="h-10 w-10 rounded-full object-cover ring-1 ring-gray-200 {{ $bidder->id == auth()->id() || auth()->user()->role === 'admin' || $hasAdminOptions ? '' : 'blur-sm' }}"
                                loading="lazy"
                            >
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-gray-900">
                                    {{ $bidder->id == auth()->id() || auth()->user()->role === 'admin' || $hasAdminOptions ? $bidder->name : 'Anonymous bidder' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Highest current offer
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between gap-3">
                        @if ($topBid)
                            <p class="text-lg font-semibold tracking-tight text-gray-900">
                                €{{ number_format($topBid->value, 0) }}
                            </p>
                        @else
                            <p class="text-xs text-gray-500">No bids yet</p>
                        @endif
                    </div>
                </div>

                <div class="space-y-3">
                    <p class="text-sm font-semibold text-gray-800">All bids</p>
                    <div
                        class="max-h-[280px] space-y-1 overflow-auto rounded-2xl border border-gray-100 bg-gray-50/60 p-3">
                        @forelse ($bids as $bid)
                            @php
                                $user = $bid->user;
                                $isAdmin = $user->id == auth()->id() || auth()->user()->role === 'admin';
                            @endphp
                            <div
                                class="flex items-center justify-between gap-3 rounded-xl bg-white px-3 py-2 text-sm text-gray-800 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <span class="text-[13px] font-semibold text-gray-900">
                                            €{{ number_format($bid->value, 0) }}
                                        </span>
                                        <span class="text-[11px] text-gray-500">
                                            {{ $isAdmin || $hasAdminOptions ? $user->name : 'Anonymous' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('images/users/' . $user->featured_image) }}"
                                        alt="{{ $user->name ? 'Avatar of ' . $user->name : 'Bid user avatar' }}"
                                        class="h-8 w-8 rounded-full object-cover ring-1 ring-gray-200 {{ $isAdmin || $hasAdminOptions ? '' : 'blur-sm' }}"
                                        loading="lazy"
                                    >
                                    @if ($hasAdminOptions)
                                        <form action="{{ route('houses.bids.destroy', [$house, $bid]) }}" method="POST"
                                            onsubmit="return confirm('Delete this bid?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="cursor-pointer rounded-full bg-red-50 px-2 py-1 text-[11px] font-medium text-red-600 transition hover:bg-red-100">
                                                Remove
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="py-4 text-center text-xs text-gray-500">
                                No bids have been placed yet.
                            </p>
                        @endforelse
                    </div>
                </div>

                <a href="{{ route('houses.bids.create', $house) }}"
                    class="mt-1 inline-flex w-full items-center justify-center rounded-full bg-gray-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-gray-800">
                    Place a bid
                </a>
            </aside>
        </div>
    </div>

    @if ($hasAdminOptions)
        <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
            <div class="relative w-full max-w-3xl rounded-2xl bg-white shadow-2xl">
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-3">
                    <h3 class="text-sm font-semibold text-gray-900">Edit house</h3>
                    <button class="rounded-md p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                        onclick="closeEditModal()" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor">
                            <path d="M6 6l12 12M6 18L18 6" />
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    <x-house-form action="{{ route('houses.update', $house) }}" method="PUT" :house="$house" />
                </div>
            </div>
        </div>

        <script>
            const editModal = document.getElementById('editModal');

            function openEditModal()
            {
                editModal.classList.remove('hidden');
                editModal.classList.add('flex');
            }

            function closeEditModal()
            {
                editModal.classList.add('hidden');
                editModal.classList.remove('flex');
            }
        </script>

    @endif
</section>