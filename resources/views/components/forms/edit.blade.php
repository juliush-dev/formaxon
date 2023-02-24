<x-app-layout>
    <x-splade-modal>
        <h2 class="text-xl mb-4">Editing form...</h2>
        <x-splade-form default="{{ $form }}" :action="route('forms.update', $form)" method='PUT' class="space-y-4 mt-4"
            preserve-scroll>
            <x-splade-input name="title" :label="__('Title')" autofocus />
            <x-button is-submitter="true" class="w-full text-center">
                {{ __('Save') }}
            </x-button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
