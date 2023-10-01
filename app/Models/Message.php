<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'content'];

    /**
     * Apartments relation
     */
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}