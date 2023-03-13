<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassStoreRequest;
use App\Http\Requests\ClassUpdateRequest;
use App\Models\ClassModel;
use App\Models\MasterClass;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {

        $classes = ClassModel::with('masterClass.event', 'mentor')->getMasterClass($request->id)->get();

        return view('dashboard.superadmin.class.index', compact('classes'));
    }

    public function create()
    {
        $mentors = User::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })->get();

        $masterClasses = MasterClass::where('status', 'active')->get();

        return view('dashboard.superadmin.class.create', compact('masterClasses', 'mentors'));
    }

    public function store(ClassStoreRequest $request)
    {
        ClassModel::create([
            'master_class_id' => $request->master_class_id,
            'responsible_id' => $request->responsible_id,
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'link' => $request->link,
            'status' => 'active',
        ]);

        return redirect()->route('superadmin.class.index')->with('success', 'Kelas ' . $request->name . ' Berhasil Ditambahkan');
    }

    public function changeStatus($id)
    {
        $data = ClassModel::find($id);

        $status = $data->status == 'active' ? 'inactive' : 'active';

        $update = $data->update([
            'status' => $status
        ]);

        return $update ? true : false;
    }

    public function delete($id)
    {
        $data = ClassModel::find($id);

        $delete = $data->delete();

        return $delete ? ['status' => 'success', 'msg' => $data->name . ' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name . ' Gagal Dihapus'];
    }

    public function edit($id)
    {
        $class = ClassModel::find($id);

        $mentors = User::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })->get();

        $masterClasses = MasterClass::where('status', 'active')->get();

        return view('dashboard.superadmin.class.edit', compact('class', 'mentors', 'masterClasses'));
    }

    public function update(ClassUpdateRequest $request, $id)
    {
        $data = ClassModel::find($id);

        $data->update([
            'master_class_id' => $request->master_class_id,
            'responsible_id' => $request->responsible_id,
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'link' => $request->link,
        ]);

        return redirect()->route('superadmin.class.index')->with('success', 'Kelas ' . $data->name . ' Berhasil Diubah');
    }
}
