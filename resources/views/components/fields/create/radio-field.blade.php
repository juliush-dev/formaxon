<h2 class="text-xl mb-4">Configuring {{ $fieldType }} field...</h2>
<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input name="label" type="text" label="Name for this options group" />
<x-splade-checkbox name="value_required" label="Required" />
<x-splade-checkbox name="field_visible_by_target" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" name="value_editable_by_target"
    label="Value provided by target" />
<x-splade-input name="value_options" label="Options (comma separated)" placeholder="Car,Vehicle,Bicycle,..." />
<x-splade-input v-if="form.value_options && form.value_options.split(',').length > 0" name="default_value"
    label="Default checked option" placeholder="Car" />
