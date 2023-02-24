<div class="min-h-screen bg-gray-100">
    <x-navigation />
    @isset($header)
        <header class="bg-white shadow p-4 mb-5 text-gray-800 sticky top-12 z-10">
            {{ $header }}
        </header>
    @endisset
    <main class="px-4">
        {{ $slot }}
    </main>
</div>
