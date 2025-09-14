<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
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
}
