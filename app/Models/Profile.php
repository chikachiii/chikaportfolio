<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'age',
        'birth_date',
        'school',
        'class',
        'description',
        'profile_image',
    ];
}
