<x-app-layout>
    <x-splade-modal>
        <x-splade-form class="space-y-2">
            <x-hint :text="__('Provide a valid title to create a new form.')" />
            <div>
                <x-splade-input v-model="form.title" class="mb-4" autofocus />
                <p v-text="form.errors.title" />
            </div>
            <x-splade-submit class="mt-4 p-2">
                {{ __('Save') }}
            </x-splade-submit>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
