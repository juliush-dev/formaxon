<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFieldData extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_field_id',
        'subscriber_id',
        'visitor_ip',
        'value',
    ];
    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }
}
