<h2 class="text-xl mb-4">Configuring {{ $fieldType }} field...</h2>
<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input v-if="form.code_name = 'email'" v-model="form.code_name" type="text" label="Field code's name"
    readonly />
<x-splade-input v-model="form.label" type="text" label="Field label" />
<x-splade-checkbox v-model="form.value_required" label="Field's value required" />
<x-splade-checkbox v-model="form.field_visible_by_target" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" v-model="form.value_editable_by_target"
    label="Field's value editable by target" />
<x-splade-checkbox v-model="form.value_is_unique" label="Value must be unique" />
<x-splade-input type="email" v-model="form.default_value" label="Default value" placeholder="example@email.com" />
