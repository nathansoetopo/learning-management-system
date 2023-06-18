<?php

namespace App\Http\Controllers;

use App\Http\Requests\GaleryStoreRequest;
use App\Http\Requests\GaleryUpdateRequest;
use App\Models\Event;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaleryController extends Controller
{
    public function index(Request $request){
        $data = Galery::all();

        return view('dashboard.superadmin.galery.index', compact('data'));
    }

    public function create(){
        $events = Event::all();

        return view('dashboard.superadmin.galery.create', compact('events'));
    }

    public function store(GaleryStoreRequest $request){
        
        $asset = $request->file('asset')->store('galery/'.$request->event_id);
        $asset = asset('storage/'.$asset);

        $data = $request->except(['_token']);
        $data['asset'] = $asset;

        Galery::create($data);

        return redirect()->route('superadmin.galery.index')->with('success', 'Berhasil Menambahkan Galeri');
    }

    public function edit($id){
        $galery = Galery::find($id);
        $events = Event::all();
        
        return view('dashboard.superadmin.galery.edit', compact('galery', 'events'));
    }

    public function update($id, GaleryUpdateRequest $request){
        $galery = Galery::find($id);

        $asset = $galery->asset;

        if($request->hasFile('asset')){

            if(File::exists(parseUrl($asset))){
                File::delete(parseUrl($asset));
            }

            $asset = $request->file('asset')->store('galery/'.$request->event_id);
            $asset = asset('storage/'.$asset);
        }

        $data = $request->except(['_token', '_method']);
        $data['asset'] = $asset;

        $galery->update($data);

        return redirect()->route('superadmin.galery.index')->with('success', 'Berhasil Mengubah Galeri');
    }

    public function updateStatus($id){
        $data = Galery::find($id);

        if($data->status == 'active'){
            $status = 'inactive';
        }else{
            $status = 'active';
        }

        $data->update(['status' => $status]);
    }

    public function delete($id){
        $data = Galery::find($id);

        $data->delete();
    }
}
