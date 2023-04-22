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

    public function getListMaterial($masterClassId){
        $materials = $this->masterMaterialService->list($masterClassId);

        return view('dashboard.mentor.materi.list', compact('materials'));
    }

    public function show($id){
        $materials = MasterClassMaterial::with('sub_materials')->find($id);

        return view('dashboard.mentor.materi.materials', compact('materials'));
    }

    public function create($id){
        return view('dashboard.mentor.materi.create', compact('id'));
    }

    public function store($id, SubMaterialStoreRequest $request){
        $this->materialService->store($id, $request);

        return redirect()->route('mentor.materials.show', ['id' => $id])->with('success', 'Materi Berhasil Disimpan');
    }

    public function edit($masterMaterialId, $id){
        $material = $this->materialService->show($id);

        return view('dashboard.mentor.materi.edit', compact('material', 'masterMaterialId'));
    }

    public function update($masterMaterialId, $id, SubMaterialStoreRequest $request){
        $this->materialService->update($id, $request);

        return redirect()->route('mentor.materials.show', ['id' => $masterMaterialId])->with('success', 'Materi Berhasil Di Update');
    }

    public function delete($masterMaterialId, $id){
        return $this->materialService->delete($id);
    }
}
