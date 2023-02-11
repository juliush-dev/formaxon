<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public const IS_ADMIN = 1;
    public const IS_ASSISTANT = 2;
    public const IS_COMPANY = 3;
    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}