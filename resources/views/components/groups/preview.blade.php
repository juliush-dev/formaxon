@props(['group'])
<div class="flex flex-col space-y-4 shadow-md bg-white rounded-md">
    <header class="relative flex space-x-5 justify-between rounded-md shadow-sm bg-white p-5">
        <h4 class="text-md font-semibold">{{ ucfirst(__($group->name)) }}</h4>
        <div class="flex space-x-5 items-baseline pt-1">
            <Link modal href="{{ route('groups.edit', $group) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            </Link>
            <Link method='DELETE' confirm href="{{ route('groups.destroy', $group) }}" class="text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </Link>
        </div>
    </header>
    <main class="flex flex-col space-y-4 px-3">
        @forelse ($group->forms as $form)
            <div class="flex justify-between p-2 rounded">
                <span>{{ $form->title }}</span>
                <div class="flex space-x-5 items-baseline ">
                    <Link modal href="{{ route('forms.edit', $form) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                    </svg>
                    </Link>
                    <Link method='DELETE' confirm
                        href="{{ route('groups.forms.destroy', ['group' => $group, 'form' => $form]) }}"
                        class="text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </Link>
                </div>
            </div>
        @empty
            <x-hint class="px-5" text="Select a form bellow." />
        @endforelse
    </main>
    <footer class="flex flex-col space-y-4 px-5 pb-5">
        @php
            $formsNotYetInGroup = \App\Models\Form::get()->diff($group->forms);
        @endphp
        @if ($formsNotYetInGroup->count() > 0)
            <x-splade-form action="{{ route('groups.forms.store', $group) }}" method="POST" submit-on-change="forms">
                <x-splade-checkboxes name="forms" label="Forms not yet in this group" :options="$formsNotYetInGroup->mapWithKeys(fn($item, $key) => [$item['id'] => $item['title']])" />
            </x-splade-form>
        @endif
    </footer>
</div>
