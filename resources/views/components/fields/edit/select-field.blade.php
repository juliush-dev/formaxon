@php
    $referencableFormFields = \App\Models\FormField::where('form_id', '!=', $form->id)
        ->where('type', \App\Enums\FormFieldType::TEXT->value)
        ->orWhere('type', \App\Enums\FormFieldType::EMAIL->value)
        ->join('forms', 'forms.id', '=', 'form_fields.form_id')
        ->select('forms.title', 'form_fields.id', 'form_fields.label')
        ->get();
    $componentName = "components.fields.create.{$fieldType}-field";
@endphp
<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input name="label" type="text" label="What information is this field asking?" />
<x-splade-checkbox name="value_required" value="1" label="Required" />
<x-splade-checkbox name="field_visible_by_target" value="1" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" value="1" name="value_editable_by_target"
    label="Value provided by target" />
<x-splade-checkbox name="value_is_unique" value="1" label="Value must be unique" />
<x-splade-checkbox name="value_is_a_set" value="1" label="Value is a set" />
{{-- reference configuration --}}
@if (count($referencableFormFields) > 0)
    <x-splade-checkbox name="value_is_reference" value="1" label="Value is reference to the field of another form" />
    <x-splade-select v-if="form.value_is_reference" name="referenced_field_id" label="Select reference field" choices>
        @foreach ($referencableFormFields as $referencableFormField)
            <option value="{{ $referencableFormField->id }}">
                {{ "{$referencableFormField->title} / {$referencableFormField->label}" }}
            </option>
        @endforeach
    </x-splade-select>
@endif
<x-splade-input v-if="!form.value_is_reference" name="value_options" label="Value Options (comma separated)"
    placeholder="Car,Vehicle,Bicycle,..." />
<x-splade-input v-if="!form.value_is_reference && form.value_is_a_set" name="default_value_set"
    label="Default value set (comma separated if many)" placeholder="Car,Vehicle,..." />
<x-splade-input v-if="form.value_options && !form.value_is_a_set && form.value_options.split(',').length > 0"
    name="default_value" label="Default value (just one value)" placeholder="Car" />
