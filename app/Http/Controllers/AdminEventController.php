<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Event::all();
        return view('admin.event',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {        
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'short_des' => 'required|string',
        'description' => 'required|string',
        'date' => 'required|string',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    
    $dates = explode('-', $request->date);
    $start_date = isset($dates[0]) ? trim($dates[0]) : null;
    $end_date = isset($dates[1]) ? trim($dates[1]) : null;
    
    // $imagePath = null;
    // if ($request->hasFile('file')) {
    //     $imagePath = $request->file('file')->store('events', 'public'); 
    // }
    
    $imagePath = null;
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Store directly in public/event_member
        $file->move(public_path('events'), $fileName);

        // Save relative path to DB
        $imagePath = 'events/' . $fileName;
    }
    

    $event = Event::find($request->id) ?? new Event();
    $event->title = $request->title;
    $event->description = $request->description;
    $event->short_des = $request->short_des;
    $event->start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
    $event->end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
    $event->registration_open = $request->registration_open ? 1 : 0;
    if($imagePath){
        $event->banner_image = $imagePath;
    }
    $event->is_active = $request->is_active ? 1 : 0;
    $event->save();
    
    $categories = $request->category;
    
    if($request->id)
    {
        Category::where('event_id', $event->id)->delete();
    }
    
    foreach ($categories as $categoryName) {
        if (!empty($categoryName)) {
            Category::firstOrCreate([
                'event_id' => $event->id,
                'name' => trim($categoryName),
            ]);
        }
    }   
        
        $rows = Event::with('categoriess')->get();
        // dd($rows);
        return view('admin.event', compact('rows'));
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
    public function create(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::with('categoriess')->find($id);
        
        $categories = $event->categories->pluck('name')->implode(',');
        
        return view('admin.event',compact('event', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::destroy($id);
        return redirect()->route('admin.event.index')->with('success', 'Event deleted successfully.');
    }
}
