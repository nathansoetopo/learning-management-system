<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Event;
use App\Models\MasterClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\MasterClassStoreRequest;
use App\Http\Requests\MasterClassUpdateRequest;
use App\Services\MasterClass\MasterClassService;

class MasterClassController extends Controller
{
    private $masterClassService;

    public function __construct(MasterClassService $masterClassService)
    {
        $this->masterClassService = $masterClassService;
    }

    public function index(Request $request){
        $event_id = $request->id?? null;

        $data['event_id'] = $event_id;

        $masterClasses = $this->masterClassService->getAll($data);

        if($request->ajax()){
            return $masterClasses;  
        }

        return view('dashboard.superadmin.master-class.index', compact('masterClasses', 'event_id'));
    }

    public function create(Request $request){
        $event_id = $request->event_id;
        $events = Event::select(['id', 'name'])->get();
        return view('dashboard.superadmin.master-class.create', compact('events', 'event_id'));
    }

    public function store(MasterClassStoreRequest $request){
        $store = $this->masterClassService->store($request);

        return redirect()->route('superadmin.master-class.index', ['id' => $store->event_id])->with('success', 'Master Class '.$store->name.' Berhasil Ditambahkan');
    }

    public function edit($id){
        $events = Event::select(['id', 'name'])->get();
        $masterClass = $this->masterClassService->find($id);

        return view('dashboard.superadmin.master-class.edit', compact('events', 'masterClass'));
    }

    public function update(MasterClassUpdateRequest $request, $id){
        $update = $this->masterClassService->updateData($id, $request);

        return redirect()->route('superadmin.master-class.index', ['id' => $update->event_id])->with('success', 'Master Class '.$update->name.' Berhasil Diubah');
    }

    public function changeStatus($id){
        return $this->masterClassService->changeStatus($id);
    }

    public function delete($id){
        return $this->masterClassService->delete($id);
    }
}
