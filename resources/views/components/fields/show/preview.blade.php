@props(['form', 'field'])
<x-splade-form class="flex flex-col space-y-5" @submit.prevent="">
    @php
        $field_code_name = "{$field->type}{$field->id}";
    @endphp
    <div class="relative">
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
            <x-splade-checkboxes :name="$field_code_name" :label="$field->label" :options="$options" inline />
        @elseif($field->type == \App\Enums\FormFieldType::RADIO->value)
            @php $options = array_map(fn($option) => trim($option), explode(',', $field->value_options));@endphp
            <x-splade-radios :name="$field_code_name" :label="$field->label" :options="$options" inline />
        @elseif($field->type == \App\Enums\FormFieldType::SELECT->value)
            <x-splade-select :name="$field_code_name" :label="$field->label" choices />
        @endif
        <footer class="space-x-4 mt-2 flex absolute -top-1.5 right-2">
            <Link modal href="{{ route('forms.fields.edit', ['form' => $form, 'field' => $field]) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>

            </Link>
            <Link class="text-red-500" confirm
                href="{{ route('forms.fields.destroy', ['form' => $form, 'field' => $field]) }}" method="DELETE">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

            </Link>
        </footer>
    </div>
</x-splade-form>
