@props(['realtor'])

@php
    $avatar = $realtor->featured_image_url
        ?? asset('images/users/' . ($realtor->featured_image ?: 'default.jpg'));

    $houses = $realtor->houses; 
    $totalHouseValue = 0; 
    $highestHouseValue = 0;
    $houseCount = count($houses); 
    foreach($houses as $house){ 
    $houseValue = $house->topBid->value;
    $totalHouseValue += $houseValue; 
    $highestHouseValue = $houseValue > $highestHouseValue ? $houseValue : $highestHouseValue; 
    } 
    $averageHouseValue = round($totalHouseValue / $houseCount);
@endphp

<section class="mx-auto px-4 py-6 sm:px-6 lg:px-0">
    {{-- Breadcrumbs --}}
    <nav class="mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="flex items-center gap-1">
            <li>
                <a href="{{ route('realtors.index') }}" class="hover:text-gray-800">Realtors</a>
            </li>
            <li aria-hidden="true" class="px-1 text-gray-400">/</li>
            <li class="font-medium text-gray-900">{{ $realtor->name }}</li>
        </ol>
    </nav>

    <div
        class="grid overflow-hidden rounded-3xl border border-gray-100 bg-white/90 shadow-lg shadow-gray-200/60 backdrop-blur-sm lg:grid-cols-[minmax(260px,1fr)_minmax(0,1.5fr)]">
        {{-- Portrait / hero --}}
        <div class="relative bg-gray-100">
            <div class="aspect-[4/5] w-full sm:aspect-[3/4] lg:aspect-[4/5]">
                <img
                    src="{{ $avatar }}"
                    alt="Portrait of {{ $realtor->name }}"
                    class="h-full w-full object-cover"
                    loading="lazy"
                >
            </div>

            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent px-5 pb-4 pt-16">
                <h1 class="text-2xl font-semibold tracking-tight text-white drop-shadow-sm">
                    {{ $realtor->name }}
                </h1>
                <p class="mt-1 inline-flex items-center rounded-full bg-white/10 px-3 py-0.5 text-xs font-medium uppercase tracking-[0.18em] text-gray-100 ring-1 ring-white/30">
                    Realtor
                </p>
            </div>
        </div>

        {{-- Main content --}}
        <div class="flex flex-col gap-6 p-6 sm:p-8">
            {{-- Contact details --}}
            <div class="flex flex-col gap-4 border-b border-gray-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Phone</p>
                        <p class="mt-1 font-medium text-gray-900">
                            <a href="tel:{{ $realtor->phone_number }}"
                                class="text-indigo-600 underline-offset-2 hover:text-indigo-700 hover:underline">
                                {{ $realtor->phone_number }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Email</p>
                        <p class="mt-1 font-medium text-gray-900 break-all">
                            <a href="mailto:{{ $realtor->email }}"
                               class="text-indigo-600 underline-offset-2 hover:text-indigo-700 hover:underline">
                                {{ $realtor->email }}
                            </a>
                        </p>
                    </div>
                </div>

                <a
                    href="mailto:{{ $realtor->email }}"
                    class="inline-flex items-center justify-center rounded-full bg-gray-900 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-gray-800">
                    Contact {{ $realtor->name }}
                </a>
            </div>

            {{-- House metrics --}}
            <section aria-label="House metrics" class="space-y-3">
                <h2 class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">
                    Portfolio metrics
                </h2>

                <div class="grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-gray-100 bg-gray-50/80 p-3">
                        <p class="text-[11px] font-medium uppercase tracking-[0.2em] text-gray-500">
                            Active listings
                        </p>
                        <p class="mt-2 text-lg font-semibold tracking-tight text-gray-900">
                            {{ $houseCount }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-gray-50/80 p-3">
                        <p class="text-[11px] font-medium uppercase tracking-[0.2em] text-gray-500">
                            Total Listings Value
                        </p>
                        <p class="mt-2 text-lg font-semibold tracking-tight text-gray-900">
                            {{ $houseCount > 0 ? '€' . number_format($totalHouseValue, 0) : '—' }}
                        </p>
                        @if ($highestHouseValue)
                            <p class="mt-1 text-[11px] text-gray-500">
                                Highest top bid: €{{ number_format($highestHouseValue, 0) }}
                            </p>
                        @endif
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-gray-50/80 p-3">
                        <p class="text-[11px] font-medium uppercase tracking-[0.2em] text-gray-500">
                            Avg. House Value
                        </p>
                        <p class="mt-2 text-lg font-semibold tracking-tight text-gray-900">
                            {{ $averageHouseValue ? '€' . number_format($averageHouseValue, 0) : '—' }}
                        </p>
                    </div>
                </div>
            </section>

            {{-- Optional bio --}}
            @if (!empty($realtor->bio ?? null))
                <section class="space-y-2">
                    <h2 class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">
                        About {{ $realtor->name }}
                    </h2>
                    <p class="text-sm leading-relaxed text-gray-700">
                        {{ $realtor->bio }}
                    </p>
                </section>
            @endif
        </div>
    </div>
</section>
