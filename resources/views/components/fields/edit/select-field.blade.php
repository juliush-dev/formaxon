<h2 class="text-xl mb-4">Configuring {{ $fieldType }} field...</h2>
<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input v-model="form.code_name" type="text" label="Field code's name" />
<x-splade-input v-model="form.label" type="text" label="Field label" />
<x-splade-checkbox v-model="form.value_required" label="Field's value required" />
<x-splade-checkbox v-model="form.field_visible_by_target" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" v-model="form.value_editable_by_target"
    label="Field's value editable by target" />
<x-splade-checkbox v-model="form.value_is_unique" label="Value must be unique" />
<x-splade-checkbox v-model="form.value_is_a_set" label="Value is a set" />
{{-- reference configuration --}}
@if (count($referencableFormFields) > 0)
    <x-splade-checkbox v-model="form.value_is_reference" label="Value is reference to the field of another form" />
    <x-splade-select v-if="form.value_is_reference" v-model="form.referenced_field_id" label="Select reference field"
        choices>
        @foreach ($referencableFormFields as $referencableFormField)
            <option value="{{ $referencableFormField->id }}">{{ $referencableFormField->label }}</option>
        @endforeach
    </x-splade-select>
    <x-splade-defer v-bind:url="`/fields/${form.referenced_field_id}/data`" v-if="form.value_is_reference"
        watch-value="form.referenced_field_id">
        <x-splade-select v-model="form.default_value_ref_id" class="mt-1" multiple>
            <option v-for="(item, index) in response" v-bind:key="index" v-bind:value="item.id">
                @{{ item.value }}
            </option>
        </x-splade-select>
    </x-splade-defer>
@endif
<x-splade-input v-if="!form.value_is_reference" v-model="form.value_options" label="Value Options (comma separated)"
    placeholder="Car,Vehicle,Bicycle,..." />
<x-splade-input v-if="!form.value_is_reference && form.value_is_a_set" v-model="form.default_value_set"
    label="Default value set (comma separated if many)" placeholder="Car,Vehicle,..." />
<x-splade-input v-if="form.value_options && !form.value_is_a_set && form.value_options.split(',').length > 0"
    v-model="form.default_value" label="Default value (just one value)" placeholder="Car" />
