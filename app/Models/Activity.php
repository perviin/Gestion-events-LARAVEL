<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'event_id',
        'user_id',
        'start_time',
        'end_time',
        'location',
        'capacity',
        'is_featured',
        'presenter',
        'additional_info'
    ];

    /**
     * Les attributs qui doivent être convertis en dates.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the event that this activity belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the participants of this activity through activity registrations.
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'activity_registrations', 'activity_id', 'user_id')
                    ->withPivot('status', 'registration_time')
                    ->withTimestamps();
    }
}