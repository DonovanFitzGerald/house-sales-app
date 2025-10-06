{{-- resources/views/houses/index.blade.php --}}
{{-- Single-file Blade view, styled with Bootstrap 5 (no routes used) --}}
@php
    /** @var \Illuminate\Pagination\AbstractPaginator|\Illuminate\Support\Collection $houses */
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Houses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap 5 CDN (remove if you already include it elsewhere) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Utilities not in Bootstrap by default */
        .line-clamp-2{
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
            overflow:hidden;
        }
    </style>
</head>
<body>
<div class="container-lg py-4">
    <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
        <h1 class="h3 mb-0">Houses</h1>

        {{-- Optional inline search (same-page submission) --}}
        <form method="GET" action="" class="d-flex align-items-center gap-2 ms-auto">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search city/county/zip…"
                class="form-control form-control-sm"
                style="width: 18rem"
            >
            <button class="btn btn-sm btn-dark">
                Search
            </button>
        </form>
    </div>

    @if ($houses->count() === 0)
        <div class="border rounded-3 bg-white p-5 text-center text-muted">
            No houses found.
        </div>
    @else
        <div class="row g-4">
            @foreach ($houses as $house)
                <x-house-card :house="$house" />
            @endforeach
        </div>

        {{-- Pagination (Bootstrap 5 renderer if available) --}}
        @if (method_exists($houses, 'links'))
            <div class="mt-4">
                {{ $houses->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @endif
</div>

{{-- Bootstrap JS (optional, for components that need JS) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
