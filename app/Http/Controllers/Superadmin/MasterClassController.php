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

class MasterClassController extends Controller
{
    public function index(Request $request){
        $event_id = $request->id;
        $masterClasses = MasterClass::with('event')->getEvent($event_id)->get();

        return view('dashboard.superadmin.master-class.index', compact('masterClasses', 'event_id'));
    }

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
            'image' => asset('storage/'.$image),
            'active_dashboard' => $request->dashboard  ? true : false,
            'status' => 'active'
        ]);

        return redirect()->route('superadmin.master-class.index', ['id' => $request->event_id])->with('success', 'Master Class '.$request->name.' Berhasil Ditambahkan');
    }

    public function edit($id){
        $events = Event::select(['id', 'name'])->get();
        $masterClass = MasterClass::find($id);

        return view('dashboard.superadmin.master-class.edit', compact('events', 'masterClass'));
    }

    public function update(MasterClassUpdateRequest $request, $id){
        $data = MasterClass::find($id);

        $image = $data->image;

        if($request->hasFile('image')){
            $url = parseUrl($data->image);

            if(File::exists($url)){
                File::delete($url);
            }

            $image = $request->file('image')->store('master_class_thumbnail');
            $image = asset('storage/'.$image);
        }

        $data->update([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image,
            'active_dashboard' => $request->dashboard  ? true : false,
        ]);

        return redirect()->route('superadmin.master-class.index', ['id' => $request->event_id])->with('success', 'Master Class '.$request->name.' Berhasil Diubah');
    }

    public function changeStatus($id){
        $data = MasterClass::find($id);

        $status = $data->status == 'active' ? 'inactive' : 'active';

        $update = $data->update([
            'status' => $status
        ]);

        return $update ? true : false;
    }

    public function delete($id){
        $data = MasterClass::find($id);

        $delete = $data->delete();

        return $delete ? ['status' => 'success', 'msg' => $data->name.' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name.' Gagal Dihapus'];
    }
}
