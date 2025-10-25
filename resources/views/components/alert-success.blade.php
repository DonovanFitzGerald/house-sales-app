<div>
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-center" role="alert">
        <!-- Display children -->
        {{ $slot }}
    </div>
    @endif
</div>