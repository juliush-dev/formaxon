@props(['form'])
@php
    $fields = $form->formFields;
@endphp
<x-app-layout>
    <x-splade-modal>
        <h2 class="text-xl mb-4">Ausfüllung eines neuen Exemplar von {{ $form->title }}</h2>
        {{-- <x-splade-form :action="route('forms.update', $form)" method='PUT' class="space-y-4 mt-4" preserve-scroll> --}}
        <x-splade-form method='PUT' class="space-y-4 mt-4" preserve-scroll>
            @foreach ($fields as $field)
                @if ($field->type == \App\Enums\FormFieldType::TEXT->value)
                    <x-splade-input name="a" type="text" :value="$field->default_value" :label="$field->label" />
                @elseif ($field->type == \App\Enums\FormFieldType::NUMBER->value)
                    <x-splade-input name="b" type="number" :value="$field->default_value" :label="$field->label" />
                @elseif($field->type == \App\Enums\FormFieldType::EMAIL->value)
                    <x-splade-input name="c" type="email" :value="$field->default_value" :label="$field->label" />
                @elseif($field->type == \App\Enums\FormFieldType::PASSWORD->value)
                    <x-splade-input name="d" type="password" :value="$field->default_value" :label="$field->label" />
                @elseif($field->type == \App\Enums\FormFieldType::CHECKBOX->value)
                    @php $options = array_map(fn($option) => trim($option), explode(',', $field->value_options));@endphp
                    <x-splade-checkboxes name="e" :label="$field->label" :options="$options" inline />
                @elseif($field->type == \App\Enums\FormFieldType::RADIO->value)
                    @php $options = array_map(fn($option) => trim($option), explode(',', $field->value_options));@endphp
                    <x-splade-radios name="f" :label="$field->label" :options="$options" inline />
                @elseif($field->type == \App\Enums\FormFieldType::SELECT->value)
                    <x-splade-select name="g" :label="$field->label" choices />
                @endif
            @endforeach
            <x-button is-submitter="true" class="w-full text-center">
                {{ __('Save') }}
            </x-button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
