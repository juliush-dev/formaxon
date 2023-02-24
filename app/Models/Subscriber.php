<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Subscriber extends Pivot
{
    public $incrementing = true;
    protected $fillable = [
        'user_id', 'subscription'
    ];
}
