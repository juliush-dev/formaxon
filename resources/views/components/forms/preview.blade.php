@props(['form'])
<div class="flex flex-col space-y-4 p-4 border shadow-sm bg-slate-200 rounded-md">
    <header>
        <h2 class="text-xl">{{ ucfirst(__($form->title)) }}</h2>
    </header>
    <main class="flex flex-col space-y-4">
        @forelse (\App\Models\FormField::where('form_id', $form->id)->get() as $field)
            <x-fields.show.preview :$form :$field />
        @empty
            <x-hint text="No Field yet. Start adding new ones!" />
        @endforelse
    </main>
    <footer class="flex flex-col space-y-4">
        <x-splade-data>
            <div class="flex flex-col space-y-4">
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
        <hr class="border-t border-slate-300">
        <div class="flex space-x-4 justify-between">
            <x-link-button modal href="{{ route('forms.edit', $form) }}">
                Edit form </x-link-button>
            <x-link-button method='DELETE'
                confirm="{{ __('Deleting this form will delete everything related to it. Continue?') }}"
                confirm-button="{{ __('Yes') }}" cancel-button="{{ __('No') }}"
                href="{{ route('forms.destroy', $form) }}" for-destruction="true">
                Delete form
            </x-link-button>
        </div>
    </footer>
</div>
