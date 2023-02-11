<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'form_group_id'
    ];

    public function form_group()
    {
        return $this->hasOne(FormGroup::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}