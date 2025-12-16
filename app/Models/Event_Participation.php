<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdEvents',
        'idUser',
        'participation_status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'IdEvents');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    protected $table = 'event_participation';

    /**
     * Count visitors by EventID.
     *
     * @param int $eventId
     * @return int
     */
    public static function countVisitorsByEventId($eventId)
    {
        return self::where('IdEvents', $eventId)
                   ->where('participation_status', 'Visiting')
                   ->count();
    }

    /**
     * Count exhibitors by EventID.
     *
     * @param int $eventId
     * @return int
     */
    public static function countExhibitorsByEventId($eventId)
    {
        return self::where('IdEvents', $eventId)
                   ->where('participation_status', 'Exhibiting')
                   ->count();
    }
}
