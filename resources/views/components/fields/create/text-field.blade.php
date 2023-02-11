<h2 class="text-xl mb-4">Configuring {{ $fieldType }} field...</h2>
<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input name="code_name" type="text" label="Field code's name" />
<x-splade-input name="label" type="text" label="Field label" />
<x-splade-checkbox name="value_required" label="Field's value required" />
<x-splade-checkbox name="field_visible_by_target" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" name="value_editable_by_target"
    label="Field's value editable by target" />
<x-splade-checkbox name="value_is_unique" label="Value must be unique" />
{{-- reference configuration --}}
@if (count($referencableFormFields) > 0)
    <x-splade-checkbox name="value_is_reference" label="Value is reference to the field of another form" />
    <x-splade-select v-if="form.value_is_reference" name="referenced_field_id" label="Select reference field"
        v-on:input="alert('ds')" choices>
        @foreach ($referencableFormFields as $referencableFormField)
            <option value="{{ $referencableFormField->id }}">
                {{ "{$referencableFormField->title} / {$referencableFormField->label}" }}</option>
        @endforeach
    </x-splade-select>
    <x-link-button id="emitter" on="team-member-added" stay @success="$splade.emit('team-member-added')"
        v-bind:href="`{{ route('forms.fields.create', $form) }}?referenced_field_id=${form.referenced_field_id}`">
        Save
    </x-link-button>
    <x-splade-rehydrate on="team-member-added">
        <x-splade-select name="default_value_ref_id" class="mt-1">
            {{-- @foreach ($team->members as $member)
                <li>{{ $member->name }}</li>
            @endforeach --}}
        </x-splade-select>
    </x-splade-rehydrate>
@endif
<x-splade-input v-if="!form.value_is_reference" name="default_value" label="Default value" class="mt-1" />
<div v-if="!form.value_is_reference" class="flex flex-col space-y-4">
    <x-hint text="Set a raisonable min and max length if necessary" class="mb-2" />
    <label>
        <span class="block">Min length</span>
        <x-splade-input class="rounded-md border-slate-300 w-full" name="value_min_length" type="number"
            min="0" />
    </label>
    <label>
        <span class="block">Max length</span>
        <x-splade-input class="rounded-md border-slate-300 w-full" name="value_max_length" type="number"
            min="0" />
    </label>
</div>
