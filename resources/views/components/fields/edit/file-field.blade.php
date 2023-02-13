<x-splade-input name="type" type="text" label="Field's type" readonly />
<x-splade-input v-model="form.label" type="text" label="What information is this field asking?" />
<x-splade-checkbox v-model="form.value_required" label="Required" />
<x-splade-checkbox v-model="form.field_visible_by_target" label="Field Visible by target" />
<x-splade-checkbox v-if="form.field_visible_by_target" v-model="form.value_editable_by_target"
    label="Value provided by target" />
<x-splade-checkbox v-model="form.value_is_unique" label="File name must be unique" />
@php
    $filesTypes = [['type' => 'pdf', 'label' => 'PDF'], ['type' => 'html', 'label' => 'HTML'], ['type' => 'js', 'label' => 'JS']];
@endphp
<x-splade-select v-model="form.accepted_file_types" label="Select supported file types" :options="$filesTypes"
    option-value="type" option-label="label" choices multiple />
