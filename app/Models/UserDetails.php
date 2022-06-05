<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'phone_number ',
        'country',
        'postcode',
        'street',
        'city',
        'house_number',
        'email',
        'password',
        'parent_id',
        'student_id',
        'user_id',
        'user_type',
        'school_class',
        'birth_date',
        'updated_at'
    ];
}
