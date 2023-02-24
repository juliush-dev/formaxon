<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventFormGroup extends Pivot
{
    protected $table = 'event_form_group';
    public $incrementing = true;
    protected $fillable = [
        'event_id', 'form_group_id'
    ];

    public function subscribers()
    {
        return $this->belongsToMany(User::class,  'subscriber', 'subscription', 'user_id')->using(Subscriber::class)->withTimestamps();
    }
}
