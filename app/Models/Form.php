<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    public function formGroups()
    {
        return $this->belongsToMany(FormGroup::class)->using(FormGroupForm::class);
    }

    public function formFields()
    {
        return $this->hasMany(FormField::class);
    }
}
