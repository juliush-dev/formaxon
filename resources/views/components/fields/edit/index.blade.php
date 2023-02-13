<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="[
            'form_id' => $field->form_id,
            'type' => $field->type,
            'label' => $field->label,
            'value_required' => $field->value_required,
            'field_visible_by_target' => $field->field_visible_by_target,
            'value_editable_by_target' => $field->value_editable_by_target,
            'value_is_unique' => $field->value_is_unique,
            'value_is_reference' => $field->value_is_reference,
            'value_is_a_set' => $field->value_is_a_set,
            'referenced_field_id' => $field->referenced_field_id,
            'default_value_ref_id' => $field->default_value_ref_id,
            'value_options' => $field->value_options,
            'default_value' => $field->default_value,
            'default_value_set' => $field->default_value_set,
            'accepted_file_types' => $field->accepted_file_types,
            'value_min_length' => $field->value_min_length,
            'value_max_length' => $field->value_max_length,
        ]" class="space-y-4" :action="route('forms.fields.update', ['form' => $form, 'field' => $field])" method="PUT">
            @php
                $componentName = "components.fields.edit.{$field->type}-field";
            @endphp
            <h2 class="text-xl mb-4">Configuring {{ $field->type }} field...</h2>
            @include($componentName)
            @error('code_name')
                <div class="text-teal-300">{{ $message }}</div>
            @enderror
            <div class="flex justify-between">
                <x-button is-submitter="$field->value_required">
                    Save
                </x-button>
                <x-button @click.prevent="modal.close()">
                    Cancel
                </x-button>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
