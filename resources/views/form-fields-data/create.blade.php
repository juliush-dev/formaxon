@props(['form'])
@php
    $fields = $form->formFields;
@endphp
<x-app-layout>
    <x-splade-modal>
        <h2 class="text-xl mb-4">Ausfüllung eines neuen Exemplar von {{ $form->title }}</h2>
        <x-splade-form :action="route('fields.data.store', $form)" method='POST' class="space-y-4 mt-4" preserve-scroll>
            @foreach ($fields as $field)
                @if ($field->type == \App\Enums\FormFieldType::TEXT->value)
                    <x-splade-input name="field_{{ $field->id }}" type="text" :value="$field->default_value" :label="$field->label" />
                @elseif ($field->type == \App\Enums\FormFieldType::NUMBER->value)
                    <x-splade-input name="field_{{ $field->id }}" type="number" :value="$field->default_value" :label="$field->label" />
                @elseif($field->type == \App\Enums\FormFieldType::EMAIL->value)
                    <x-splade-input name="field_{{ $field->id }}" type="email" :value="$field->default_value" :label="$field->label" />
                @elseif($field->type == \App\Enums\FormFieldType::PASSWORD->value)
                    <x-splade-input name="field_{{ $field->id }}" type="password" :value="$field->default_value"
                        :label="$field->label" />
                @elseif($field->type == \App\Enums\FormFieldType::CHECKBOX->value)
                    @php
                        $optionsArray = array_map(fn($option) => trim($option), explode(',', $field->value_options));
                        $options = array_reduce(
                            $optionsArray,
                            function ($accu, $option) {
                                $accu["$option"] = $option;
                                return $accu;
                            },
                            [],
                        );
                    @endphp
                    <x-splade-checkboxes name="field_{{ $field->id }}" :label="$field->label" :options="$options" inline />
                @elseif($field->type == \App\Enums\FormFieldType::RADIO->value)
                    @php
                        $optionsArray = array_map(fn($option) => trim($option), explode(',', $field->value_options));
                        $options = array_reduce(
                            $optionsArray,
                            function ($accu, $option) {
                                $accu["$option"] = $option;
                                return $accu;
                            },
                            [],
                        );
                    @endphp
                    <x-splade-radios name="field_{{ $field->id }}" :label="$field->label" :options="$options" inline />
                @elseif($field->type == \App\Enums\FormFieldType::SELECT->value)
                    @php
                        $options = [];
                        $optionsArray = [];
                        $alreadyTakenOptions = [];
                        if ($field->value_is_unique) {
                            $alreadyTakenOptions = \App\Models\FormFieldData::where('form_field_id', $field->id)
                                ->select('value')
                                ->get()
                                ->toArray();
                            if (collect($alreadyTakenOptions)->count() > 0) {
                                if ($field->value_is_a_set) {
                                    $alreadyTakenOptions = collect($alreadyTakenOptions)
                                        ->map(function (string $takenOptionSets) {
                                            return array_map(fn($takenOptionSet) => trim($takenOptionSet), explode(',', $takenOptionSets));
                                        })
                                        ->toArray();
                                } else {
                                    $alreadyTakenOptions = $alreadyTakenOptions->toArray();
                                }
                            }
                        }
                        if ($field->value_is_reference) {
                            $optionsArray = \App\Models\FormFieldData::where('form_field_id', $field->refenced_field_id)
                                ->select('value')
                                ->get()
                                ->toArray();
                        } else {
                            $optionsArray = array_map(fn($option) => trim($option), explode(',', $field->value_options));
                        }
                        $remainingOptionsToChoseFrom = array_diff($optionsArray, $alreadyTakenOptions);
                        $optionsArray = $remainingOptionsToChoseFrom;
                        $options = array_reduce(
                            $optionsArray,
                            function ($accu, $option) {
                                $accu["$option"] = $option;
                                return $accu;
                            },
                            [],
                        );
                    @endphp
                    @if ($field->value_is_a_set)
                        <x-splade-select name="field_{{ $field->id }}" :label="$field->label" :options="$options" choices
                            multiple />
                    @else
                        <x-splade-select name="field_{{ $field->id }}" :label="$field->label" :options="$options"
                            choices />
                    @endif
                @endif
            @endforeach
            <x-button is-submitter="true" class="w-full text-center">
                {{ __('Save') }}
            </x-button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
