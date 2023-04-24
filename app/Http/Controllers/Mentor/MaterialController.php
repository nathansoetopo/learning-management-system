<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubMaterialStoreRequest;
use App\Models\MasterClassMaterial;
use App\Services\MasterClassMaterial\MasterClassMaterialService;
use App\Services\Material\MaterialService;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private $userService;
    private $masterMaterialService;
    private $materialService;

    public function __construct(UserService $userService, MasterClassMaterialService $masterMaterialService, MaterialService $materialService)
    {
        $this->userService = $userService;
        $this->masterMaterialService = $masterMaterialService;
        $this->materialService = $materialService;
    }
    
    public function index(){
        $data = $this->userService->getProfile(Auth::user()->id);
        return view('dashboard.mentor.materi.index', compact('data'));
    }

    public function getListMaterial($classId){
        $materials = $this->masterMaterialService->list($classId);

        return view('dashboard.mentor.materi.list', compact('materials', 'classId'));
    }

    public function show($classId, $id){
        $materials = MasterClassMaterial::with(['sub_materials' => function($sub) use ($classId){
            $sub->where('class_id', $classId);
        }])->find($id);

        return view('dashboard.mentor.materi.materials', compact('materials', 'classId'));
    }

    public function create($classId, $id){
        return view('dashboard.mentor.materi.create', compact('id', 'classId'));
    }

    public function store($classId, $id, SubMaterialStoreRequest $request){
        $this->materialService->store($classId, $id, $request);

        return redirect()->route('mentor.materials.show', ['id' => $id, 'classId' => $classId])->with('success', 'Materi Berhasil Disimpan');
    }

    public function edit($classId, $masterMaterialId, $id){
        $material = $this->materialService->show($id);

        return view('dashboard.mentor.materi.edit', compact('material', 'masterMaterialId', 'classId'));
    }

    public function update($classId, $masterMaterialId, $id, SubMaterialStoreRequest $request){
        $this->materialService->update($id, $request);

        return redirect()->route('mentor.materials.show', ['id' => $masterMaterialId, 'classId' => $classId])->with('success', 'Materi Berhasil Di Update');
    }

    public function delete($class_id, $masterMaterialId, $id){
        return $this->materialService->delete($id);
    }
}
