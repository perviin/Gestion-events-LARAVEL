<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'date', 'capacity', 'price', 'image'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}