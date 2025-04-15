<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'date', 'capacity', 'price', 'category', 'image', 'user_id', 'organizer_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function tickets()
    {
        return $this->belongsTo(User::class);
    }
    
    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participations')
                    ->withPivot('registration_date', 'notes')
                    ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

}