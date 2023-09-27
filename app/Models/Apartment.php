<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'category_id', 'description', 'price', 'rooms', 'beds', 'bathroom', 'square_meters', 'address', 'latitude', 'longitude', 'image', 'is_visible'];

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
     * Category relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
