<x-app-layout>
    <x-splade-modal>
        {{-- @php
            dd($event);
        @endphp --}}
        <x-splade-form :default="$event" :action="route('events.update', $event)" method="PUT" preserve-scroll>
            <x-splade-input name="name" :label="__('Event Name')" class="mb-4" />
            <x-splade-textarea name="description" :label="__('Description')" class="mb-4" autosize />
            <x-splade-input name="location" :label="__('Location')" class="mb-4" />
            <x-splade-input name="at" date :label="__('Start date')" class="mb-4" />
            <x-splade-group name="target" :label="__('Target')" class="mb-4" inline>
                <x-splade-radio name="target" :value="App\Models\Event::TARGET_COMPANY" :label="__('Companies')" />
                <x-splade-radio name="target" :value="App\Models\Event::TARGET_VISITOR" :label="__('Visitors')" />
            </x-splade-group>
            <x-splade-checkbox name="visible_by_target" value="1" label="Published" />
            <x-splade-submit class="mt-4 p-2 w-full bg-blue-500 text-white rounded">
                Save
            </x-splade-submit>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
