<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'category_id', 'description', 'price', 'rooms', 'beds', 'bathrooms', 'square_meters', 'address', 'latitude', 'longitude', 'image', 'is_visible', 'delete_image'];

    /**
     * Category relation
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Services relation
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * User relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Messages relation
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Get image path
    public function get_image()
    {
        return asset('storage/' . $this->image);
    }
}
