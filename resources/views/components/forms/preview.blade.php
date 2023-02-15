@props(['form'])
<x-splade-toggle>
    <div class="flex flex-col space-y-2 shadow-sm bg-white  rounded-md">
        <header class="flex flex-col space-y-5">
            <div class="flex space-x-5 items-baseline justify-between rounded-md shadow-md bg-white p-5">
                <h1 class="text-2xl m-0 p-0">{{ ucfirst(__($form->title)) }}</h1>
                <span class="text-xs rounded-sm bg-rose-400 text-white p-1 px-4">{{ $form->formFields()->count() }}
                    F
                </span>
                <div class="flex space-x-5 items-baseline">
                    <Link modal href="{{ route('forms.edit', $form) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path
                            d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                    </svg>
                    </Link>
                    <Link method='DELETE'
                        confirm="{{ __('Deleting this form will delete everything related to it. Continue?') }}"
                        confirm-button="{{ __('Yes') }}" cancel-button="{{ __('No') }}"
                        href="{{ route('forms.destroy', $form) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-5 h-5 fill-red-500">
                        <path fill-rule="evenodd"
                            d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                            clip-rule="evenodd" />
                    </svg>

                    </Link>
                    {{-- expand button --}}
                    <svg v-show="!toggled" @click.prevent="toggle" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path
                            d="M13.28 7.78l3.22-3.22v2.69a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.69l-3.22 3.22a.75.75 0 001.06 1.06zM2 17.25v-4.5a.75.75 0 011.5 0v2.69l3.22-3.22a.75.75 0 011.06 1.06L4.56 16.5h2.69a.75.75 0 010 1.5h-4.5a.747.747 0 01-.75-.75zM12.22 13.28l3.22 3.22h-2.69a.75.75 0 000 1.5h4.5a.747.747 0 00.75-.75v-4.5a.75.75 0 00-1.5 0v2.69l-3.22-3.22a.75.75 0 10-1.06 1.06zM3.5 4.56l3.22 3.22a.75.75 0 001.06-1.06L4.56 3.5h2.69a.75.75 0 000-1.5h-4.5a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0V4.56z" />
                    </svg>
                    {{-- collapse button --}}
                    <svg v-show="toggled" @click.prevent="toggle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" class="w-5 h-5">
                        <path
                            d="M3.28 2.22a.75.75 0 00-1.06 1.06L5.44 6.5H2.75a.75.75 0 000 1.5h4.5A.75.75 0 008 7.25v-4.5a.75.75 0 00-1.5 0v2.69L3.28 2.22zM13.5 2.75a.75.75 0 00-1.5 0v4.5c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-2.69l3.22-3.22a.75.75 0 00-1.06-1.06L13.5 5.44V2.75zM3.28 17.78l3.22-3.22v2.69a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.69l-3.22 3.22a.75.75 0 101.06 1.06zM13.5 14.56l3.22 3.22a.75.75 0 101.06-1.06l-3.22-3.22h2.69a.75.75 0 000-1.5h-4.5a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0v-2.69z" />
                    </svg>
                </div>
            </div>
        </header>
        <main v-show="toggled" class="flex flex-col space-y-5 p-5">
            <x-splade-data>
                <div class="flex flex-col space-y-5">
                    <x-splade-select v-model="data.field_type" label="Add a new field" choices>
                        <option value="" selected disabled>Select the field's type</option>
                        @foreach (\App\Enums\FormFieldType::cases() as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </x-splade-select>
                    <x-link-button modal v-if="data.field_type"
                        v-bind:href="`{{ route('forms.fields.create', $form) }}?field_type=${data.field_type}`"
                        class="text-center">
                        Add
                    </x-link-button>
                </div>
            </x-splade-data>
            @forelse ($form->formFields as $field)
                <x-fields.show.preview :$form :$field />
            @empty
                <x-hint text="No field yet. Start adding new ones!" />
            @endforelse
        </main>
    </div>
</x-splade-toggle>
