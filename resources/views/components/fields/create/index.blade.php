<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="[
            'form_id' => null,
            'type' => $fieldType,
            'label' => null,
            'value_required' => true,
            'field_visible_by_target' => true,
            'value_editable_by_target' => true,
            'value_is_unique' => true,
            'value_is_reference' => null,
            'value_is_a_set' => null,
            'referenced_field_id' => null,
            'default_value_ref_id' => null,
            'value_options' => null,
            'default_value' => null,
            'default_value_set' => null,
            'accepted_file_types' => null,
            'value_min_length' => null,
            'value_max_length' => null,
        ]" class="space-y-4" :action="route('forms.fields.store', $form)" method="POST">
            @php
                $componentName = "components.fields.create.{$fieldType}-field";
            @endphp
            @include($componentName)
            @error('code_name')
                <div class="text-teal-300">{{ $message }}</div>
            @enderror
            <div class="flex justify-between">
                <x-button is-submitter="true">
                    Save
                </x-button>
                <x-button @click.prevent="modal.close()">
                    Cancel
                </x-button>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
