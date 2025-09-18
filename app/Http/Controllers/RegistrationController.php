<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\EventTeamPaticipents;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showForm($eventId)
    {
        $event = Event::findOrFail($eventId);
        $categories = Category::where('event_id', $eventId)->get();
        return view('registration.form', compact('event', 'categories'));
    }

    public function submit(Request $request, $eventId)
    {
        // Validate and store registration (simplified)
        $data = $request->validate([
            'participation_type' => 'required',
            'team_name' => 'nullable|string',
            'team_size' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'email' => 'required|email',
            'contact_number' => 'required',
            'class' => 'required',
            'division' => 'required',
            'members' => 'nullable',
        ]);
        $data['event_id'] = $eventId;
        Registration::create($data);
        // TODO: Send confirmation email
        return redirect()->back()->with('success', 'Registration successful!');
    }
    
    public function event_register_submit(Request $request)
    {
        /*
        $validated = $request->validate([
            'team_name'      => 'required|string|max:255',
            'team_size'      => 'required|integer|min:1',
            'category_id'    => 'required|integer|exists:categories,id',
            'event_id'       => 'required|integer|exists:events,id',

            'name'           => 'required|array|min:1',
            'name.*'         => 'required|string|max:255',

            'email'          => 'required|array|min:1',
            'email.*'        => 'required|email|max:255',

            'contact_number' => 'required|array|min:1',
            'contact_number.*'=> 'required|string|max:20',

            'class'          => 'nullable|array',
            'class.*'        => 'nullable|string|max:255',

            'division'       => 'nullable|array',
            'division.*'     => 'nullable|string|max:255',
        ]);
        */

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'category_id' => 'required|exists:categories,id',
            'team_name' => 'nullable|string|max:255',
            'team_size' => 'required|in:1,2',
            'team_number' => 'required_if:team_size,2|integer|min:2|max:7',
            'name.*' => 'required|string|max:255',
            'contact_number.*' => 'required|string|max:15',
            'email.*' => 'required|email',
            'class.*' => 'required|string|max:255',
            'division.*' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($validated['event_id']);
        if($event->registration_open == 0){
            return redirect()->back()->with('error', 'Registration for this event is closed.');
        }

        // Create Registration record
        $registration = Registration::create([
            'event_id'     => $validated['event_id'],
            'team_name'    => $validated['team_name'],
            'team_size'    => $validated['team_size'],
            'category_id'  => $validated['category_id'],
        ]);

        // Store team members
        foreach ($validated['name'] as $index => $name) {
            EventTeamPaticipents::create([
                'registration_id' => $registration->id,
                'name'           => $name,
                'email'          => $validated['email'][$index],
                'contact_number' => $validated['contact_number'][$index],
                'class'          => $validated['class'][$index] ?? '',
                'division'       => $validated['division'][$index] ?? '',
            ]);
        }

        return redirect()->back()->with('success', 'Registration successful!');
    }

}
