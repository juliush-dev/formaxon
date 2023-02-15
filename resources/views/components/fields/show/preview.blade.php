@props(['form', 'field'])
<x-splade-form class="flex flex-col space-y-5" @submit.prevent="">
    @php
        $field_code_name = "{$field->type}{$field->id}";
    @endphp
    <div>
        @if ($field->type == \App\Enums\FormFieldType::TEXT->value)
            <x-splade-input :name="$field_code_name" type="text" :value="$field->default_value" :label="$field->label" readonly />
        @elseif ($field->type == \App\Enums\FormFieldType::NUMBER->value)
            <x-splade-input :name="$field_code_name" type="number" :value="$field->default_value" :label="$field->label" readonly />
        @elseif($field->type == \App\Enums\FormFieldType::EMAIL->value)
            <x-splade-input :name="$field_code_name" type="email" :value="$field->default_value" :label="$field->label" readonly />
        @elseif($field->type == \App\Enums\FormFieldType::PASSWORD->value)
            <x-splade-input :name="$field_code_name" type="password" :value="$field->default_value" :label="$field->label" readonly />
        @elseif($field->type == \App\Enums\FormFieldType::CHECKBOX->value)
            @php $options = array_map(fn($option) => trim($option), explode(',', $field->value_options));@endphp
            <x-splade-checkboxes :name="$field_code_name" :label="$field->label" :options="$options" />
        @elseif($field->type == \App\Enums\FormFieldType::RADIO->value)
            @php $options = array_map(fn($option) => trim($option), explode(',', $field->value_options));@endphp
            <x-splade-radios :name="$field_code_name" :label="$field->label" :options="$options" />
        @elseif($field->type == \App\Enums\FormFieldType::SELECT->value)
            <x-splade-select :name="$field_code_name" :label="$field->label" choices />
        @endif
        <footer class="flex space-x-4 mt-2">
            <Link modal href="{{ route('forms.fields.edit', ['form' => $form, 'field' => $field]) }}">
            Edit field
            </Link>
            <Link class="text-red-500" confirm
                href="{{ route('forms.fields.destroy', ['form' => $form, 'field' => $field]) }}" method="DELETE">
            Delete field
            </Link>
        </footer>
    </div>
</x-splade-form>
