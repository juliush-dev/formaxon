<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFieldData extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_field_id',
        'participant_id',
        'visitor_id',
        'value',
    ];
    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }
}