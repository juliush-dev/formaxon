<x-app-layout>
    @include('forms.show-header')
    <x-splade-modal>
        <x-splade-form default="{{ $form }}" :action="route('forms.update', $form)" method='PUT' class="space-y-4 mt-4">
            <x-splade-input name="title" :label="__('Title')" autofocus />
            <x-button is-submitter="true" class="w-full text-center">
                {{ __('Save') }}
            </x-button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
