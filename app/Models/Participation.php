<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'status', // ex: 'registered', 'attended', 'cancelled'
        'registration_date',
        'notes',
    ];

    /**
     * Les attributs qui doivent être convertis en dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'registration_date',
    ];

    /**
     * Get the user that owns the participation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that this participation is for.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function participants()
    {
        return $this->hasMany(Participation::class);
    }
}