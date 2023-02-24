<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            @can('if_admin')
                <Link modal href="{{ route('events.create') }}" class="border rounded px-4 py-1 shadow-sm">
                New Event
                </Link>
            @endcan
        </span>
    </x-slot>
    <div class="flex flex-col space-y-5">
        @php
            $events = [];
        @endphp
        @can('if_admin')
            @php
                $events = \App\Models\Event::get();
            @endphp
        @elsecan('if_visitor')
            @php
                $events = \App\Models\Event::join('event_form_group', 'events.id', '=', 'event_form_group.event_id')
                    ->where('target', \App\Models\Event::TARGET_VISITOR)
                    ->where('visible_by_target', true)
                    ->select('events.*')
                    ->distinct()
                    ->get();
            @endphp
        @elsecan('if_company')
            @php
                $events = \App\Models\Event::whereNotIn(
                    'id',
                    \App\Models\EventFormGroup::join('subscriber', 'subscriber.subscription', '=', 'event_form_group.id')
                        ->select('event_form_group.event_id')
                        ->where('subscriber.user_id', auth()->user()->id),
                )
                    ->where('target', \App\Models\Event::TARGET_COMPANY)
                    ->where('visible_by_target', true)
                    ->whereDate('at', '>=', now())
                    ->get();
            @endphp
        @endcan
        @foreach ($events as $event)
            <div class="flex flex-col pb-4 shadow-md bg-white rounded-md">
                <header class="relative flex space-x-5 justify-between rounded-md shadow-sm bg-white p-5">
                    <h4 class="text-md font-semibold">{{ ucfirst(__($event->name)) }}</h4>
                    @can('if_admin')
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
                    @endcan
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
                                @can('if_admin')
                                    <tr>
                                        <td class="px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                            </svg>

                                        </td>
                                        <td class="pr-5">{{ ucfirst($event->target) }}</td>
                                    </tr>
                                @endcan
                                @can('if_admin')
                                    <tr>
                                        <td class="px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                            </svg>
                                        </td>
                                        <td
                                            class="pr-5 {{ $event->visible_by_target ? 'text-lime-600' : 'text-rose-600' }}">
                                            {{ $event->visible_by_target ? 'Published' : 'Not published yet' }}
                                        </td>
                                    </tr>
                                @endcan
                            </tbody>
                        </table>
                    </section>
                    @php
                        $formsGroups = $event->formGroups;
                    @endphp
                    @if ($formsGroups->count() > 0)
                        <section class="flex flex-col space-y-5">
                            <h5 class="font-medium text-md px-5 flex space-x-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 -ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                                </svg>
                                @can('if_admin')
                                    <span>Packages</span>
                                @elsecan('if_company')
                                    <span>Subscribe to one of the following packages to participate in this
                                        event.</span>
                                @elsecan('if_visitor')
                                    <span>Fill the forms of one of the following packages to participate in this
                                        event.</span>
                                @endcan
                            </h5>
                            <div class="flex flex-col space-y-4">
                                @foreach ($formsGroups as $group)
                                    <div
                                        class="px-4 py-4 flex justify-between items-center bg-gradient-to-r from-violet-200/60">
                                        <span class="flex flex-nowrap space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                            </svg>
                                            <span>{{ $group->name }}</span></span>
                                        @canany(['if_company', 'if_visitor'])
                                            <div class="flex space-x-4">
                                                <Link href="{{ route('groups.show', $group) }}" method="GET"
                                                    class="text-white text-sm px-2 py-1 shadow-md bg-lime-500 rounded flex space-x-2 items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                                <span>Preview</span>
                                                </Link>
                                                @can('if_company')
                                                    <Link
                                                        href="{{ route(
                                                            'subscribe',
                                                            \App\Models\EventFormGroup::where('event_id', $event->id)->where('form_group_id', $group->id)->first(),
                                                        ) }}"
                                                        method="POST"
                                                        class="text-white text-sm px-2 py-1 bg-blue-500 rounded  shadow-md flex space-x-2 items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                                                    </svg>
                                                    <span>Subscribe</span>
                                                    </Link>
                                                @elsecan('if_visitor')
                                                    <Link
                                                        class="text-white text-sm px-2 py-1 shadow-md bg-blue-500 rounded flex space-x-2 items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                    <span>Fill</span>
                                                    </Link>
                                                @endcan
                                            </div>
                                        @endcanany
                                        @can('if_admin')
                                            <div class="flex space-x-5 items-baseline ">
                                                <Link modal href="{{ route('groups.edit', $group) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                                </svg>
                                                </Link>
                                                <Link method='DELETE' confirm
                                                    href="{{ route('events.groups.destroy', ['event' => $event, 'group' => $group]) }}"
                                                    class="text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                </Link>
                                            </div>
                                        @endcan
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @else
                        @can('if_admin')
                            @php
                                $text = $formsGroups->count() == 0 ? 'No package in the system. Create some.' : 'Click on a package to add it to this event.';
                            @endphp
                            <x-hint class="px-4" :$text />
                        @endcan
                    @endif
                </main>
                @can('if_admin')
                    <footer class="flex flex-col space-y-4 mt-4">
                        @php
                            $groupsNotYetInEvent = \App\Models\FormGroup::get()->diff($event->formGroups);
                        @endphp
                        @if ($groupsNotYetInEvent->count() > 0)
                            <x-splade-form action="{{ route('events.groups.store', $event) }}" method="POST"
                                submit-on-change="groups" class="px-5">
                                <x-splade-checkboxes name="groups" label="Packages not yet in this event"
                                    :options="$groupsNotYetInEvent->mapWithKeys(
                                        fn($item, $key) => [$item['id'] => $item['name']],
                                    )" />
                            </x-splade-form>
                        @endif
                    </footer>
                @endcan
            </div>
        @endforeach
    </div>
</x-app-layout>
