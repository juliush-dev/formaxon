<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="['name' => null]" class="space-y-2">
            <x-splade-input name="name" class="mb-4" label="Name" autofocus />
            <x-splade-submit class="mt-4 p-2">
                {{ __('Save') }}
            </x-splade-submit>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
