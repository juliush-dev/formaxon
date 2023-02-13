<x-app-layout>
    @include('groups.show-header')
    <x-splade-modal>
        <x-splade-form default="{{ $group }}" :action="route('groups.update', $group)" method='PUT' class="space-y-4 mt-4">
            <x-splade-input name="name" :label="__('Title')" autofocus />
            <x-button is-submitter="true" class="w-full text-center">
                {{ __('Save') }}
            </x-button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
