<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event_Participation;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'IdEvents';

    protected $fillable = [
        'event_name',
        'event_description',
        'event_date',
        'event_location',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Get the participations for the event.
     */
    public function participants()
    {
        return $this->hasMany(Event_Participation::class, 'IdEvents');
    }

    /**
     * Get the number of visitors for the event.
     */
    public function visitorsCount()
    {
        return $this->participants()->where('participation_status', 'Visiting')->count();
    }

    /**
     * Get the number of exhibitors for the event.
     */
    public function exhibitorsCount()
    {
        return $this->participants()->where('participation_status', 'Exhibiting')->count();
    }

    /**
     * Get the number of others for the event.
     */
    public function othersCount()
    {
        return $this->participants()->where('participation_status', 'Other')->count();
    }
}

