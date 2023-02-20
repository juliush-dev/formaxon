<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventParticipant extends Pivot
{
    protected $table = 'event_participant';
    public $incrementing = true;
    protected $fillable = [
        'user_id', 'event_id'
    ];

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
}
