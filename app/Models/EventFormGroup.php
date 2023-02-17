<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventFormGroup extends Pivot
{
    protected $table = 'event_form_group';
    protected $fillable = [
        'event_id', 'form_group_id'
    ];
}
