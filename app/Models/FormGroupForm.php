<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FormGroupForm extends Pivot
{
    protected $table = 'form_form_group';
    protected $fillable = [
        'form_id', 'form_group_id'
    ];
}
