<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class houses extends Model
{
    use HasFactory;
    protected $table ='houses';
    protected $primaryKey = 'house_id';
    protected $fillable =['house_title', 'house_description', 'house_rooms', 'house_bathrooms', 'house_kitchen', 'house_booking_status', 'house_address', 'house_size', 'owner_id','house_rent','rent_type'];
}
