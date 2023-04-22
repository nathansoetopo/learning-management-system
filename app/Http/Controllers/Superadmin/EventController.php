<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\MasterClass;
use App\Services\Event\EventService;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(){
        $events = $this->eventService->getAll();
        return view('dashboard.superadmin.events.index', compact('events'));
    }

    public function create(){
        return view('dashboard.superadmin.events.create');
    }

    public function store(EventStoreRequest $request){
        $create = $this->eventService->store($request);

        return redirect()->route('superadmin.events.index')->with('success', 'Event '.$create->name.' Berhasil Ditambahkan');
    }

    public function edit($uuid){
        $event = $this->eventService->find($uuid);

        return view('dashboard.superadmin.events.edit', compact('event'));
    }

    public function update(EventUpdateRequest $request, $uuid){
        $update = $this->eventService->updateData($uuid, $request);
        return redirect()->route('superadmin.events.index')->with('success', 'Event '.$update->name.' Berhasil Diupdate');
    }

    public function delete($uuid){
        $delete = $this->eventService->deleteData($uuid);

        return $delete;
    }

    public function changeStatus($uuid){
        return $this->eventService->changeStatus($uuid);
    }

    public function masterClassList(Request $request){
        $event_id = $request->id;
        $masterClasses = MasterClass::with('event')->where('event_id', $event_id)->get();

        return view('dashboard.superadmin.master-class.index', compact('masterClasses', 'event_id'));
    }
}
