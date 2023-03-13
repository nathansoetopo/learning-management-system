<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\MasterClass;
use Illuminate\Support\Facades\File;

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

    public function edit($uuid){
        $event = Event::find($uuid);

        return view('dashboard.superadmin.events.edit', compact('event'));
    }

    public function update(EventUpdateRequest $request, $uuid){
        
        $data = Event::find($uuid);

        $image = $data->image;

        if($request->hasFile('image')){
            $url = parseUrl($data->image);

            if(File::exists($url)){
                File::delete($url);
            }

            $image = $request->file('image')->store('events_thumbnail');
            $image = asset('storage/'.$image);
        }

        $data->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $image
        ]);

        return redirect()->route('superadmin.events.index')->with('success', 'Event '.$request->name.' Berhasil Diupdate');
    }

    public function delete($uuid){
        $data = Event::find($uuid);

        $delete = $data->delete();

        return $delete ? ['status' => 'success', 'msg' => $data->name.' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name.' Gagal Dihapus'];
    }

    public function changeStatus($uuid){
        $data = Event::find($uuid);

        $status = $data->status == 'active' ? 'inactive' : 'active';

        $update = $data->update([
            'status' => $status
        ]);

        return $update ? true : false;
    }

    public function masterClassList(Request $request){
        $event_id = $request->id;
        $masterClasses = MasterClass::with('event')->where('event_id', $event_id)->get();

        return view('dashboard.superadmin.master-class.index', compact('masterClasses', 'event_id'));
    }
}
