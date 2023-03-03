<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            @can('if_admin')
                Admin action
            @elsecan('if_company')
                company action
            @endcan
        </span>
    </x-slot>
    <div class="flex flex-col space-y-5">
        @php
            $subscriptions = [];
        @endphp
        @can('if_admin')
            @php
                $subscriptions = \App\Models\Subscriber::get();
            @endphp
        @elsecan('if_company')
            @php
                $subscriptions = auth()
                    ->user()
                    ->subscriptions()
                    ->orderByPivot('created_at', 'asc')
                    ->get();
            @endphp
        @endcan
        @can('if_company')
            @foreach ($subscriptions as $subscription)
                @php
                    $event = \App\Models\Event::find($subscription->event_id);
                    $form_group = \App\Models\FormGroup::find($subscription->form_group_id);
                    $forms = $form_group->forms;
                @endphp
                <div class="flex flex-col space-y-4 shadow-md bg-white rounded-md">
                    <header class="relative flex space-x-5 justify-between items-center rounded-md shadow-sm bg-white p-5">
                        <h4 class="text-md font-semibold flex space-x-6">
                            <span>{{ ucfirst($event->name) }}</span>
                            <span
                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                {{ ucfirst($form_group->name) }}
                            </span>
                        </h4>
                        <Link method='DELETE' confirm href="{{ route('subscriptions.destroy', $subscription) }}"
                            class="text-red-500">
                        Unsubscribe
                        </Link>
                    </header>
                    <main class="flex flex-col space-y-4 px-3">
                        <table class="text-slate-800">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-5 w-5"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                            </svg>
                                        </td>
                                        <td class="pr-5 {{ $event->visible_by_target ? 'text-lime-600' : 'text-rose-600' }}">
                                            {{ $event->visible_by_target ? 'Published' : 'Not published yet' }}
                                        </td>
                                    </tr>
                                @endcan
                            </tbody>
                        </table>
                    </main>
                    <footer class="flex flex-col space-y-4 pb-5">
                        @foreach ($forms as $form)
                            <div class="flex flex-col space-y-3">
                                <div
                                    class="bg-gradient-to-r from-violet-500/80 flex text-white justify-between p-2  items-center">
                                    <span>{{ $form->title }}</span>
                                    <x-link-button modal method='GET' href="{{ route('fields.data.create', $form) }}"
                                        preserve-scroll class="flex space-x-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        <span class="text-sm">Fill new examplar</span>
                                    </x-link-button>
                                </div>
                                @php
                                    // dd($subscription->subscribers);
                                    $formFieldsData = \App\Models\FormFieldData::where('subscriber_id', auth()->user()->id)
                                        ->whereIn('form_field_id', $form->formFields->map(fn($field) => $field->id)->toArray())
                                        ->get();
                                @endphp
                                @if ($formFieldsData->count() > 0)
                                    <div class="flex justify-between space-x-4 pl-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                @else
                                    <x-hint text="No examplar found. Create some." />
                                @endif
                            </div>
                        @endforeach
                    </footer>
                </div>
            @endforeach
        @endcan
    </div>
</x-app-layout>
