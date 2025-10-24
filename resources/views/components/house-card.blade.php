@php
  $berBadge = function (string $rating): string {
    return match ($rating) {
      'A1', 'A2', 'A3' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
      'B1', 'B2', 'B3' => 'bg-lime-100 text-lime-700 ring-lime-200',
      'C1', 'C2', 'C3' => 'bg-yellow-100 text-yellow-700 ring-yellow-200',
      'D1', 'D2' => 'bg-amber-100 text-amber-700 ring-amber-200',
      'E1', 'E2', 'F', 'G' => 'bg-red-100 text-red-700 ring-red-200',
      default => 'bg-gray-100 text-gray-700 ring-gray-200',
    };
  };
@endphp

@props(['house'])

<div class="w-full p-2">
  <a href="{{ route('houses.show', $house) }}" class="group block focus:outline-none">
    <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition
             hover:-translate-y-0.5 hover:shadow-md focus-within:ring-2 focus-within:ring-indigo-500">

      {{-- Media --}}
      <div class="relative group-hover:scale-[1.02]">
        <img src="{{ $house->featured_image_url ?? asset('images/houses/' . $house->featured_image) }}"
          onerror="this.src='https://placehold.co/800x600?text=House';"
          alt="Photo of {{ $house->address_line_1 }}, {{ $house->city }}"
          class="aspect-[4/3] w-full object-cover transition duration-300 " />

        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-black/55 to-transparent">
        </div>

        <h2 class="absolute bottom-2 left-3 right-3 truncate text-sm font-semibold text-white drop-shadow"
          title="{{ $house->address_line_1 }}">
          {{ $house->address_line_1 }}
        </h2>

        {{-- BER badge (no inline-flex) --}}
        <span
          class="absolute left-2 top-2 rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $berBadge($house->energy_rating) }}">
          {{ $house->energy_rating }}
        </span>
      </div>

      {{-- Body --}}
      <div class="flex flex-1 flex-col p-4">
        <div class="mb-1 flex items-center justify-between gap-3">
          <p class="truncate text-xs text-gray-500" title="{{ $house->city }}, {{ $house->county }} {{ $house->zip }}">
            {{ $house->city }}, {{ $house->county }} {{ $house->zip }}
          </p>

          <span
            class="shrink-0 rounded-full bg-gray-50 px-2 py-0.5 text-[10px] font-medium capitalize text-gray-600 ring-1 ring-inset ring-gray-200">
            {{ $house->house_type }}
          </span>
        </div>

        {{-- Facts row (no inline-flex) --}}
        <dl class="mt-2 grid grid-cols-3 gap-2 text-xs text-gray-700">
          <div class="flex items-center gap-1.5">
            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path
                d="M6 7a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v3h1a1 1 0 0 1 1 1v6h-2v-2H4v2H2v-6a1 1 0 0 1 1-1h1V7h2Zm2 0v3h8V7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1Z" />
            </svg>
            <dt class="sr-only">Beds</dt>
            <dd>{{ $house->beds }} beds</dd>
          </div>

          <div class="flex items-center gap-1.5">
            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path
                d="M7 3a3 3 0 0 1 3 3v3h9a1 1 0 1 1 0 2h-1v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3H3a1 1 0 1 1 0-2h1V6a3 3 0 0 1 3-3Zm0 2a1 1 0 0 0-1 1v3h4V6a1 1 0 0 0-1-1H7Z" />
            </svg>
            <dt class="sr-only">Baths</dt>
            <dd>{{ $house->baths }} baths</dd>
          </div>

          <div class="flex items-center gap-1.5">
            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm0 2v14h14V5H5Z" />
            </svg>
            <dt class="sr-only">Area</dt>
            <dd>{{ number_format($house->square_metres) }} m²</dd>
          </div>
        </dl>

        <p class="mt-3 line-clamp-2 text-sm text-gray-700">
          {{ $house->description }}
        </p>
      </div>

      {{-- Footer --}}
      <div class="flex items-center justify-between border-t border-gray-100 px-4 py-3">
        <span class="text-xs text-gray-500">Tap to view details</span>
        <span class="flex items-center gap-1 text-sm font-medium text-indigo-600 group-hover:text-indigo-700">
          View
          <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" viewBox="0 0 20 20" fill="currentColor"
            aria-hidden="true">
            <path fill-rule="evenodd"
              d="M3 10a1 1 0 0 1 1-1h9.586L11.293 6.707a1 1 0 1 1 1.414-1.414l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 1 1-1.414-1.414L13.586 11H4a1 1 0 0 1-1-1Z"
              clip-rule="evenodd" />
          </svg>
        </span>
      </div>
    </article>
  </a>

  @if(auth()->user()->role === 'admin')
    <div class="mt-4 flex space-x-2">
      <!-- Edit Button route to houses.edit and receives $house for editing -->
      <a href="{{ route('houses.edit', $house) }}"
        class="text-white bg-orange-500 hover:bg-orange-700 font-bold py-2 px-4 rounded">
        Edit
      </a>

      <!-- Delete Button route to houses.destroy -->
      <form action="{{ route('houses.destroy', $house) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this house?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 cursor-pointer hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
          Delete
        </button>
      </form>
    </div>
  @endif

</div>