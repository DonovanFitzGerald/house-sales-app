
@php
$berBadge = function (string $rating): string {
    // Map BER to Bootstrap badge variants
    return match ($rating) {
        'A1','A2','A3' => 'text-bg-success',
        'B1','B2','B3' => 'text-bg-success',
        'C1','C2','C3' => 'text-bg-warning',
        'D1','D2'      => 'text-bg-warning',
        'E1','E2','F','G' => 'text-bg-danger',
        default        => 'text-bg-secondary',
    };
};
@endphp

@props(['house'])

<div class="col-12 col-sm-6 col-lg-4">
    <a href="{{ route('houses.show', $house) }}" class="text-decoration-none">
        <div class="card shadow-sm h-100">
            {{-- Image --}}
            <div class="position-relative">
                <div class="ratio ratio-4x3 bg-light">
                    <img
                        src="https://www.bhg.com/thmb/TD9qUnFen4PBLDuB2hn9yhGXPv8=/1866x0/filters:no_upscale():strip_icc()/white-house-a-frame-section-c0a4a3b3-e722202f114e4aeea4370af6dbb4312b.jpg"
                        onerror="this.src='https://placehold.co/800x600?text=House';"
                        alt="Photo of {{ $house->address_line_1 }}, {{ $house->city }}"
                        class="object-fit-cover w-100 h-100"
                    >
                </div>

                {{-- BER badge --}}
                <span class="badge {{ $berBadge($house->energy_rating) }} position-absolute top-0 start-0 m-2 rounded-pill">
                    {{ $house->energy_rating }}
                </span>
            </div>

            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between gap-3 mb-1">
                    <h2 class="card-title h6 mb-0 text-truncate" title="{{ $house->address_line_1 }}">
                        {{ $house->address_line_1 }}
                    </h2>
                    <span class="small text-muted text-capitalize">{{ $house->house_type }}</span>
                </div>

                <p class="card-subtitle small text-muted text-truncate mb-2"
                    title="{{ $house->city }}, {{ $house->county }} {{ $house->zip }}">
                    {{ $house->city }}, {{ $house->county }} {{ $house->zip }}
                </p>

                {{-- Quick facts --}}
                <div class="d-flex align-items-center flex-wrap gap-3 small text-body-secondary">
                    <span class="d-inline-flex align-items-center gap-1">
                        {{-- bed icon --}}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v3h1a1 1 0 0 1 1 1v6h-2v-2H4v2H2v-6a1 1 0 0 1 1-1h1V7h2Zm2 0v3h8V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1Z"/></svg>
                        {{ $house->beds }} beds
                    </span>
                    <span class="d-inline-flex align-items-center gap-1">
                        {{-- bath icon --}}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 3a3 3 0 0 1 3 3v3h9a1 1 0 1 1 0 2h-1v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3H3a1 1 0 1 1 0-2h1V6a3 3 0 0 1 3-3Zm0 2a1 1 0 0 0-1 1v3h4V6a1 1 0 0 0-1-1H7Z"/></svg>
                        {{ $house->baths }} baths
                    </span>
                    <span class="d-inline-flex align-items-center gap-1">
                        {{-- area icon --}}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm0 2v14h14V5H5Z"/></svg>
                        {{ number_format($house->square_metres) }} m²
                    </span>
                </div>

                <p class="mt-2 mb-0 small text-body line-clamp-2">
                    {{ $house->description }}
                </p>

                {{-- Make the whole card clickable --}}
                <span class="stretched-link"></span>
            </div>
        </div>
    </a>
</div>