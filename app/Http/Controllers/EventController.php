<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        $searchEvent = request('searchEvent');
        $events = Event::query()
        ->when($searchEvent, fn($query) =>
        $query->where('title', 'like', "%{$searchEvent}%")
        )
        ->latest()
        ->get();
        
        $user = Auth::user();
        return view('welcome', compact('events', 'searchEvent'));
    }

    public function show($id) {
        $event = Event::findOrFail($id);
        $eventOwner = $event->user;
        $user = Auth::user();
    
        return view('events.show', compact('event'));
    }

    public function create() 
    {
        return view( 'events.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title'           => 'required|string',
            'date'            => 'required|date',
            'time'            => 'required|date_format:H:i',
            'location'        => 'required|string',
            'available_slots' => 'required|integer|min:1|max:100',
            'description'     => 'required|string|min:5|max:1000',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $event = new Event($request->except('image'));
        $event->user_id = Auth::id();

        // Upload de imagem
        if ($request->hasFile('image')) {
            $imageName = md5($request->image->getClientOriginalName() . microtime()) . '.' . $request->image->extension();
            $request->image->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return redirect()->route('events.index')
            ->with('msg', 'Evento criado com sucesso!');
    }

    public function dashboard() {
        $user = Auth::user();

        return view('events.dashboard', [
            'events'     => $user->events,
            'subscribed' => $user->subscribedEvents,
        ]);
    }

    public function destroy($id) {
        $event = Event::findOrFail($id);

        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não pode excluir este evento.');
        }

        $event->subscribers()->detach();
        $event->delete();

        return redirect()->route('events.dashboard')
            ->with('msg', 'Evento excluído com sucesso!');
    }
    
    public function update(Request $request) {
        Event::findOrFail($request->id)->update($request->all());
        return redirect()->route('events.dashboard')->with('msg','Evento editado com sucesso!');
    }

    public function joinEvent($id) {
        $user = Auth::user();

        if (!$user->subscribedEvents()->where('event_id', $id)->exists()) {
            $user->subscribedEvents()->attach($id);
        }

        $event = Event::findOrFail($id);

        return back()->with('msg', 'Sua presença está confirmada no evento ' . $event->title);
    }
    
    public function leaveEvent($id) {

            $user = Auth::user();
            $user->subscribedEvents()->detach($id);
    
            $event = Event::findOrFail($id);
    
            return back()->with('msg', 'Você saiu do evento ' . $event->title);
    }
}