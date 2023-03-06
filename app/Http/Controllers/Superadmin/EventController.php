<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;

class EventController extends Controller
{
    public function index(){
        $events = Event::withCount('masterClass')->get();
        return view('dashboard.superadmin.events.index', compact('events'));
    }

    public function create(){
        return view('dashboard.superadmin.events.create');
    }

    public function store(EventStoreRequest $request){
        $image = $request->file('image')->store('events_thumbnail');

        Event::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => asset('storage/'.$image)
        ]);

        return redirect()->route('superadmin.events.index')->with('success', 'Event '.$request->name.' Berhasil Ditambahkan');
    }
}
