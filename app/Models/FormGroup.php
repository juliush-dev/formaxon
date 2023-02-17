<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class)->using(EventFormGroup::class);
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class)->using(FormGroupForm::class);
    }

    public function Subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}
