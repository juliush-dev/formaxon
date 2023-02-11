<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$event">
            <x-splade-input name="name" :label="__('Event Name')" class="mb-4" />
            <x-splade-textarea name="description" :label="__('Description')" class="mb-4" autosize />
            <x-splade-input name="location" :label="__('Location')" class="mb-4" />
            <x-splade-input name="start_date" date :label="__('Start date')" class="mb-4" />
            <x-splade-input name="end_date" date :label="__('End date')" class="mb-4" />
            <x-splade-group name="target" :label="__('Target')" class="mb-4" inline>
                <x-splade-radio name="target" :value="App\Models\Event::TARGET_COMPANY" :label="__('Companies')" />
                <x-splade-radio name="target" :value="App\Models\Event::TARGET_VISITOR" :label="__('Visitors')" />
            </x-splade-group>
            @if ($formGroups->count() == 0)
                <p class="text-md text-slate-400">
                    {{ __('No group available. Make sure to create forms and groups in order to setup advanced settings') }}
                </p>
            @else
                <x-splade-group name="field_visible_by_target" :label="__('Visible by target')" class="mb-4" inline>
                    <x-splade-radio name="field_visible_by_target" value="1" :label="__('Yes')" />
                    <x-splade-radio name="field_visible_by_target" value="0" :label="__('No')" />
                </x-splade-group>
                <x-splade-checkboxes name="formGroups" :label="__('Form groups')" :options="$formGroups" option-label="title"
                    option-value="id" relation />
            @endif
            <x-splade-submit class="mt-4 p-2">
                {{ __('Update') }}
            </x-splade-submit>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
