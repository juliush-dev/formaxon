<x-app-layout>
    @include('event.show-header')
    @include('components.participants', [
        'participants' => App\Models\Participant::class,
    ])
</x-app-layout>
