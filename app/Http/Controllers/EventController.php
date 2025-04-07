<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events');
        }

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events');
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Événement mis à jour.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé.');
    }
}