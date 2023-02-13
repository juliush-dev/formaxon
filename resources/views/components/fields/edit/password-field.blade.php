<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-checkbox name="value_required" value="1" label="Required" />
<x-splade-checkbox name="field_visible_by_target" value="1" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" value="1" name="value_editable_by_target"
    label="Value provided by target" />
<x-splade-checkbox name="value_is_unique" value="1" label="Value must be unique" />
<x-hint text="Set the min and max length the password must have" class="mb-2" />
<label>
    <span class="block">Password min length</span>
    <x-splade-input class="rounded-md border-slate-300 w-full" name="value_min_length" type="number" min="0" />
</label>
<label>
    <span class="block">Password max length</span>
    <x-splade-input class="rounded-md border-slate-300 w-full" name="value_max_length" type="number" min="0" />
</label>
