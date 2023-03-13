<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\MasterClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\MasterClassStoreRequest;

class MasterClassController extends Controller
{
    public function create(){
        $events = Event::select(['id', 'name'])->get();
        return view('dashboard.superadmin.master-class.create', compact('events'));
    }

    public function store(MasterClassStoreRequest $request){
        $image = $request->file('image')->store('master_class_thumbnail');

        MasterClass::create([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image,
            'active_dashboard' => $request->dashboard == 'on' ? true : false,
            'status' => 'active'
        ]);

        return redirect()->route('superadmin.events.masterclass', ['id' => $request->event_id])->with('success', 'Master Class '.$request->name.' Berhasil Ditambahkan');
    }
}
