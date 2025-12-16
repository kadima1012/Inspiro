<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Event_Participation;



class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();

        $events->each(function ($event) {
            $eventId = $event->IdEvents;
            $event->visitors_count = Event_Participation::countVisitorsByEventId($eventId);
            $event->exhibitors_count = Event_Participation::countExhibitorsByEventId($eventId);
        });

        return view('home.events', compact('events'));
    }

}
