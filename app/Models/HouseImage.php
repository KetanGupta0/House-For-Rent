<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    use HasFactory;
    protected $table = 'house_images';
    protected $primaryKey = 'image_id';
    protected $fillable = ['image_belongs_to','image_name'];
}
