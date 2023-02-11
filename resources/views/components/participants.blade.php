<div class="mt-5">
    <h1 class="text-2xl">Participants</h1>
    <x-splade-table class="mt-5" :for="$participants" striped>
        {{-- <x-splade-cell name as="$event">
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
            <x-dropdown>
                <x-slot name="trigger">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                        {{ __('Options') }}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content" class="p">
                    <Link href="{{ route('events.edit', ['event' => $item]) }}"
                        class="text-gray-700 block px-4 py-2 text-sm">
                    Edit </Link>
                    <Link href="{{ route('events.destroy', ['event' => $item]) }}"
                        class="text-gray-700 block px-4 py-2 text-sm">
                    Delete </Link>
                </x-slot>
            </x-dropdown>
        </x-splade-cell> --}}
    </x-splade-table>
</div>
