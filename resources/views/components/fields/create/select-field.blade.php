@php
    $referencableForms = \App\Models\Form::where('id', '!=', $form->id)->get();
    $componentName = "components.fields.create.{$fieldType}-field";
@endphp
<h2 class="text-xl mb-4">Configuring {{ $fieldType }} field...</h2>
<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input name="label" type="text" label="What information is this field asking?" />
<x-splade-checkbox name="value_required" label="Required" />
<x-splade-checkbox name="field_visible_by_target" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" name="value_editable_by_target"
    label="Value provided by target" />
<x-splade-checkbox name="value_is_a_set" label="Multiple choices possible"
    @checked="form.value_is_unique = !form.value_is_a_set" />
{{-- reference configuration --}}
@if (count($referencableForms) > 0)
    <x-splade-data :default="['referenced_form_id' => null]">
        <x-splade-checkbox name="value_is_reference" label="Value is reference to the field of another form" />
        <x-splade-select v-if="form.value_is_reference" v-model="data.referenced_form_id" label="Select a form"
            :options="$referencableForms->mapWithKeys(fn($item, $key) => [$item['id'] => $item['title']])" choices />
        <x-splade-select v-if="form.value_is_reference && data.referenced_form_id" name="referenced_field_id"
            remote-url="`/forms/${data.referenced_form_id}/fields`" label="Select a field" />
    </x-splade-data>
@endif
<x-splade-input v-if="!form.value_is_reference" name="value_options" label="Value Options (comma separated)"
    placeholder="Car,Vehicle,Bicycle,..." />
<x-splade-input
    v-if="!form.value_is_reference && form.value_is_a_set && form.value_options && form.value_options.split(',').length > 0"
    name="default_value_set" label="Default value set (comma separated if many)" placeholder="Car,Vehicle,..." />
<x-splade-input v-if="form.value_options && !form.value_is_a_set && form.value_options.split(',').length > 0"
    name="default_value" label="Default value (just one value)" placeholder="Car" />
