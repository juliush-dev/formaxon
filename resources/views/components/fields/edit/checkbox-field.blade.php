<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input name="label" type="text" label="Name for this options group" />
<x-splade-checkbox name="value_required" value="1" label="Required" />
<x-splade-checkbox name="field_visible_by_target" value="1" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" value="1" name="value_editable_by_target"
    label="Value provided by target" />
<x-splade-input name="value_options" label="Options (comma separated)" placeholder="Car,Vehicle,Bicycle,..." />
<x-splade-input v-if="form.value_options && form.value_options.split(',').length > 0" name="default_value_set"
    label="Default checked option" placeholder="Car" />
