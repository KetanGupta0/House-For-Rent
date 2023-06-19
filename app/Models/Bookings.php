<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'booked_by', 'booking_status', 'payment_status', 'payment_id', 'payment_time', 'approved_by', 'house_id', 'approval_timestamp', 'canceled_by', 'cancel_time', 'customer_name', 'card_number', 'card_holder'
    ];

    public $timestamps = false;
}
