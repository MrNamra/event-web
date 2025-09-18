<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    public function index()
    {
        $rows = EventMember::all();
        return view('admin.event_member',compact('rows'));
    }
    
    public function store(Request $request)
    {        
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'des' => 'required|string',
            'role' => 'required|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Store directly in public/event_member
            $file->move(public_path('event_member'), $fileName);

            // Save relative path to DB
            $imagePath = 'event_member/' . $fileName;
        }
        // $event = EventMember::findOrFail($request->id);
        $event = EventMember::find($request->id) ?? new EventMember();
        
        $event->name = $request->name;
        $event->des = $request->des;
        $event->role = $request->role;
                
        if($imagePath){
            $event->profile = $imagePath;
        }
        $event->save();
                
        $rows = EventMember::all();
        // dd($rows);
        return view('admin.event_member',compact('rows'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function updateStatus(Request $request, $eventId)
    {
        // $eventId = $request->all('event_id');
        $event = Event::find($eventId);
        if ($event) {
            $event->registration_open = !$event->registration_open;
            $event->save();
            return redirect()->route('admin.event.index')->with('success', 'Event status updated successfully.');
            
        }
        return redirect()->route('admin.event.index')->with('error', 'Event not found.');
    }
    
    public function update(Request $request, string $id)
    {
        $data = EventMember::find($id);
        return view('admin.event_member',compact('data'));
    }
    public function destroy(string $id)
    {
        EventMember::destroy($id);
        return redirect()->route('admin.event_member.index')->with('success', 'Event member deleted successfully.');
    }
}
