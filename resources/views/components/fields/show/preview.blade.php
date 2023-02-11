@props(['form', 'field'])
<x-splade-form class="flex flex-col space-y-2" @submit.prevent="">
    @if ($field->type == \App\Enums\FormFieldType::TEXT->value)
        <x-splade-input :name="$field->code_name" type="text" :value="$field->default_value" :label="$field->label" readonly />
    @elseif($field->type == \App\Enums\FormFieldType::EMAIL->value)
        <x-splade-input :name="$field->code_name" type="email" :value="$field->default_value" :label="$field->label" readonly />
    @elseif($field->type == \App\Enums\FormFieldType::PASSWORD->value)
        <x-splade-input :name="$field->code_name" type="password" :value="$field->default_value" :label="$field->label" readonly />
    @elseif($field->type == \App\Enums\FormFieldType::CHECKBOX->value)
        <x-splade-checkbox :name="$field->code_name" :value="$field->default_value" :label="$field->label" @checked($field->checked)
            readonly />
    @elseif($field->type == \App\Enums\FormFieldType::RADIO->value)
        <x-splade-radio :name="$field->code_name" :value="$field->default_value" :label="$field->label" @checked($field->checked)
            readonly />
    @elseif($field->type == \App\Enums\FormFieldType::SELECT->value)
        <x-splade-select :name="$field->code_name" :label="$field->label" choices />
    @endif
</x-splade-form>
<footer class="flex space-x-4 justify-end">
    <x-link-button modal href="{{ route('forms.fields.edit', ['form' => $form, 'field' => $field]) }}">
        Edit field
    </x-link-button>
    <x-link-button for-destruction="true" confirm
        href="{{ route('forms.fields.destroy', ['form' => $form, 'field' => $field]) }}" method="DELETE">
        Delete field
    </x-link-button>
</footer>
