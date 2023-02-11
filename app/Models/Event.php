<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'location', 'at', 'user_id',
        'description', 'thumbnail', 'field_visible_by_target', 'target'
    ];
    const TARGET_VISITOR = 'visitor';
    const TARGET_COMPANY = 'company';

    public function formGroups()
    {
        return $this->hasMany(FormGroup::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
