<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'at', 'location', 'target',  'visible_by_target', 'thumbnail'
    ];
    const TARGET_VISITOR = 'visitor';
    const TARGET_COMPANY = 'company';

    public function formGroups()
    {
        return $this->belongsToMany(FormGroup::class)->using(EventFormGroup::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participant', 'event_id', 'user_id')->using(EventParticipant::class);
    }
}
