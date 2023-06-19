<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected$fillable = [
        'user_name',
        'user_phone',
        'user_aadhar',
        'user_email',
        'user_password',
        'user_country',
        'user_state',
        'user_city',
        'user_pincode',
        'user_type',
        'user_picture'
    ];
}
