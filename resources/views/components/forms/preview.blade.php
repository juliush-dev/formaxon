@props(['form'])
<div class="flex flex-col space-y-2 shadow-md bg-white  rounded-md">
    <header class="relative flex space-x-5 justify-between rounded-md shadow-sm bg-white p-5">
        <h4 class="text-md font-semibold">{{ ucfirst(__($form->title)) }}</h4>
        <div class="flex space-x-5 items-baseline pt-1">
            <Link modal href="{{ route('forms.edit', $form) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            </Link>
            <Link method='DELETE'
                confirm="{{ __('Deleting this form will delete everything related to it. Continue?') }}"
                confirm-button="{{ __('Yes') }}" cancel-button="{{ __('No') }}"
                href="{{ route('forms.destroy', $form) }}" class="text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </Link>
        </div>
    </header>
    <main class="flex flex-col space-y-5 p-5">
        <x-splade-data>
            <div class="flex flex-col space-y-5 mb-5">
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
