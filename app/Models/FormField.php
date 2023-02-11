<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'type',
        'label',
        'code_name',
        'value_required',
        'field_visible_by_target',
        'value_editable_by_target',
        'checked',
        'value_is_unique',
        'value_is_reference',
        'value_is_a_set',
        'referenced_field_id',
        'default_value_ref_id',
        'value_options',
        'default_value',
        'default_value_set',
        'accepted_file_types',
        'value_min_length',
        'value_max_length',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function formFieldData()
    {
        return $this->hasMany(FormFieldData::class);
    }
}