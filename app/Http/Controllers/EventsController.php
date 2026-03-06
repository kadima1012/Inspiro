<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_Participation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventsController extends Controller
{
    public function index(): View
    {
        $events = Event::withCount([
            'participants as visitors_count' => function ($query) {
                $query->where('participation_status', 'Visiting');
            },
            'participants as exhibitors_count' => function ($query) {
                $query->where('participation_status', 'Exhibiting');
            },
        ])->with('participants')->get();

        return view('home.events', compact('events'));
    }

    public function join(Request $request, int $event): RedirectResponse
    {
        $user = auth()->user();

        $existing = Event_Participation::where('IdEvents', $event)
            ->where('idUser', $user->idUser)
            ->first();

        if ($existing) {
            return redirect()->route('events')->with('error', 'You are already registered for this event.');
        }

        Event_Participation::create([
            'IdEvents' => $event,
            'idUser' => $user->idUser,
            'participation_status' => $request->input('status', 'Visiting'),
        ]);

        return redirect()->route('events')->with('success', 'You have joined the event!');
    }

    public function leave(int $event): RedirectResponse
    {
        $user = auth()->user();

        Event_Participation::where('IdEvents', $event)
            ->where('idUser', $user->idUser)
            ->delete();

        return redirect()->route('events')->with('success', 'You have left the event.');
    }
}
