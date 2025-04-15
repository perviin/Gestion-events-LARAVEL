<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['participants', 'participations'])->paginate(9);

        $categories = [
            (object)['id' => 'Concert', 'name' => 'Concert'],
            (object)['id' => 'Festival', 'name' => 'Festival'],
            (object)['id' => 'Conférence', 'name' => 'Conférence'],
            (object)['id' => 'Workshop', 'name' => 'Workshop'],
            (object)['id' => 'Sport', 'name' => 'Sport'],
            (object)['id' => 'Exposition', 'name' => 'Exposition'],
            (object)['id' => 'Autre', 'name' => 'Autre']
        ];
        
        return view('events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = [
            (object)['id' => 'Concert', 'name' => 'Concert'],
            (object)['id' => 'Festival', 'name' => 'Festival'],
            (object)['id' => 'Conférence', 'name' => 'Conférence'],
            (object)['id' => 'Workshop', 'name' => 'Workshop'],
            (object)['id' => 'Sport', 'name' => 'Sport'],
            (object)['id' => 'Exposition', 'name' => 'Exposition'],
            (object)['id' => 'Autre', 'name' => 'Autre']
        ];

        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'date' => 'required|date',
        'capacity' => 'required|integer',
        // 'price' => 'required|numeric',
        'category' => 'required|string|max:255',
        'description' => 'required',
        'address' => 'required',
        // 'image' => 'nullable|image|max:2048'
    ]);

    $data = $request->all();
    
    // Ajouter l'ID de l'utilisateur connecté
    $data['organizer_id'] = auth()->id(); 
    
    /* if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('events');
    } */

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
        // Vérifiez que l'utilisateur connecté est bien propriétaire de l'événement
        if ($event->organizer_id !== auth()->id()) {
            return redirect()->route('events.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet événement.');
        }
    
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            // 'image' => 'nullable|image|max:2048'
        ]);
    
        $data = $request->all();
        
        // Conserver l'ID de l'utilisateur
        $data['organizer_id'] = auth()->id();
        
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

    public function getLocations()
    {   
    // Lire les noms de fichiers dans le dossier des images de lieux
    $imageFiles = glob(public_path('img/locations/*.jpg'));
    $locations = [];
    
    foreach ($imageFiles as $file) {
        // Extraire le nom du lieu à partir du nom de fichier
        $filename = basename($file, '.jpg');
        // Convertir le slug en nom lisible (optionnel)
        $locationName = ucwords(str_replace('-', ' ', $filename));
        
        if ($filename !== 'default') {
            $locations[] = $locationName;
        }
    }
    
    return response()->json($locations);
    }
}