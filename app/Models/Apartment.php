<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillables = ['title', 'description', 'price', 'rooms', 'beds', 'bathroom', 'square_meters', 'address', 'latitude', 'longitude', 'image', 'is_visible'];
}
