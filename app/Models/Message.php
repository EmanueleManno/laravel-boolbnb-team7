<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'content', 'apartment_id'];

    /**
     * Apartments relation
     */
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
