<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function Subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}