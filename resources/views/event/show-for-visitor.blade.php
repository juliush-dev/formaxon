<x-app-layout>
    <x-slot name="header">
        {{ __('Events') }}
    </x-slot>
    <x-splade-table class="mt-5" :for="$events" striped>
        <x-splade-cell name as="$event">
            <span class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <Link href="{{ route('events.show', $event) }}" class="text-blue-600">{{ $event->name }}</Link>
            </span>
        </x-splade-cell>
        <x-splade-cell target as="$event">
            <span>{{ ucfirst(__($event->target)) }}</span>
        </x-splade-cell>
        <x-splade-cell visible_for_target as="$event">
            @if ($event->visible_for_target)
                <span>
                    {{ __('Yes') }}
                </span>
            @else
                <span>
                    {{ __('No') }}
                </span>
            @endif
        </x-splade-cell>
        <x-splade-cell actions>
            <x-splade-toggle class="relative">
                <button @click.prevent="toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
                <x-splade-transition class="absolute top-50 w-20 z-10" show="toggled">
                    <ul class="mx-auto bg-white shadow-lg rounded-md p-6 flex flex-col space-y-4">
                        <!-- The current user can create posts... -->
                        <li>
                            <Link href="/evetns/{{ $item->id }}/edit"> Edit </Link>
                        </li>
                        <li>
                            <Link href="/evetns/{{ $item->id }}/delete"> Delete </Link>
                        </li>
                    </ul>
                </x-splade-transition>
            </x-splade-toggle>
        </x-splade-cell>
    </x-splade-table>
</x-app-layout>
