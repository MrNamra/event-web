<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Show the event marked as 'homepage' or 'featured', fallback to latest
        $members = EventMember::all();
        $events = Event::orderBy('start_date', 'desc')->get();
        return view('events.index', [
            'events' => $events,
            'teammembers' => $members
        ]);
    }

    public function show($id)
    {
        $event = Event::where('title', $id)->first();
        $categories = $event ? $event->categories : [];
        return view('events.event_register', compact('event','categories'));
    }
    
    public function view_participants($id)
    {
        $event = Event::findOrFail($id);
        $participants = $event->participants->load('team');
        // dd($participants);
        return view('admin.view_participants', compact('event', 'participants'));
    }
}
