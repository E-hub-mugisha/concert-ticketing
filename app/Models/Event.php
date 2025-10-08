<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'venue', 'event_date', 'capacity', 'image'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    protected $casts = [
        'event_date' => 'datetime',
    ];
}
