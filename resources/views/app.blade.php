<div class="min-h-screen">
    <x-navigation />
    @isset($header)
        <header class="bg-gray-900 text-white shadow p-4 sticky top-16 z-10">
            {{ $header }}
        </header>
    @endisset
    <main class="p-4">
        {{ $slot }}
    </main>
</div>
