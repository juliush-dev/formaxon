<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            <h1 class="text-2xl">Events</h1>
            <Link modal href="{{ route('events.create') }}" class="border rounded-md px-4 py-2">
            New Event
            </Link>
        </span>
    </x-slot>
    <div class="flex flex-col space-y-5 p-5">
        @foreach (\App\Models\Event::get() as $event)
            <div class="flex flex-col space-y-4 shadow-md bg-white rounded-md">
                <header class="relative flex space-x-5 justify-between rounded-md shadow-sm bg-white p-5">
                    <h4 class="text-md font-semibold">{{ ucfirst(__($event->name)) }}</h4>
                    <div class="flex space-x-5 items-baseline pt-1">
                        <Link modal href="{{ route('events.edit', $event) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        </Link>
                        <Link method='DELETE' confirm href="{{ route('events.destroy', $event) }}" class="text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        </Link>
                    </div>
                </header>
                <main class="flex flex-col space-y-4">
                    <section>
                        <table class="text-slate-800">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-5"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                        </svg></td>
                                    <td class="pr-5">{{ $event->description }}</td>
                                </tr>
                                <tr>
                                    <td class="align-text-top px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg></td>
                                    <td class="pr-5">{{ $event->at }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </td>
                                    <td class="pr-5">{{ $event->location }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section>
                        @forelse ($event->formGroups as $group)
                            <div class="p-5 flex justify-between">
                                <span>{{ $group->name }}</span>
                                <div class="flex space-x-5 items-baseline ">
                                    <Link modal href="{{ route('groups.edit', $group) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                    </svg>
                                    </Link>
                                    <Link method='DELETE' confirm
                                        href="{{ route('events.groups.destroy', ['event' => $event, 'group' => $group]) }}"
                                        class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    </Link>
                                </div>
                            </div>
                        @empty
                            <x-hint class="px-5" text="Select some groups bellow." />
                        @endforelse
                    </section>
                </main>
                <footer class="flex flex-col space-y-4">
                    @php
                        $groupsNotYetInEvent = \App\Models\FormGroup::get()->diff($event->formGroups);
                    @endphp
                    @if ($groupsNotYetInEvent->count() > 0)
                        <x-splade-form action="{{ route('events.groups.store', $event) }}" method="POST"
                            submit-on-change="groups" class="p-5 rounded-b">
                            <x-splade-checkboxes name="groups" label="Groups not yet in this event"
                                :options="$groupsNotYetInEvent->mapWithKeys(
                                    fn($item, $key) => [$item['id'] => $item['name']],
                                )" />
                        </x-splade-form>
                    @endif
                </footer>
            </div>
        @endforeach
    </div>
</x-app-layout>
