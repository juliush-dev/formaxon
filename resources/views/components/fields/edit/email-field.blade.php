<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input name="label" type="text" label="What information is this field asking?" />
<x-splade-checkbox name="value_required" value="1" label="Required" />
<x-splade-checkbox name="field_visible_by_target" value="1" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" value="1" name="value_editable_by_target"
    label="Value provided by target" />
<x-splade-checkbox name="value_is_unique" value="1" label="Value must be unique" />
<x-splade-input type="email" name="default_value" label="Default value" placeholder="example@email.com" />
