<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-6">
        <div class="mb-6 flex items-center justify-between gap-3">
            <h1 class="text-xl font-semibold text-gray-900">Houses</h1>

            <form method="GET" action="" class="ml-auto flex items-center gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search city/county/zip…"
                    class="w-72 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <button
                    class="cursor-pointer inline-flex items-center rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Search
                </button>
            </form>
        </div>

        @if (method_exists($houses, 'links'))
            <div class="my-6">
                {{ $houses->withQueryString()->links() }}
            </div>
        @endif

        @if ($houses->count() === 0)
            <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                No houses found.
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($houses as $house)
                    <x-house-card :house="$house" />
                @endforeach
            </div>

            @if (method_exists($houses, 'links'))
                <div class="mt-6">
                    {{ $houses->withQueryString()->links() }}
                </div>
            @endif
        @endif
    </div>
</x-app-layout>