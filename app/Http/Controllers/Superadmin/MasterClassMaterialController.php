<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\MasterClassMaterial;
use App\Services\MasterClassMaterial\MasterClassMaterialService;
use Illuminate\Http\Request;

class MasterClassMaterialController extends Controller
{
    private $masterClassMaterialService;

    public function __construct(MasterClassMaterialService $masterClassMaterialService)
    {
        $this->masterClassMaterialService = $masterClassMaterialService;
    }

    public function index(Request $request){
        $data = MasterClassMaterial::where('master_class_id', $request->master_class_id)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function create(Request $request){
        return $this->masterClassMaterialService->create($request);
    }

    public function show(Request $request){
        return $this->masterClassMaterialService->show($request);
    }

    public function update($id, Request $request){
        return $this->masterClassMaterialService->update($id, $request->except(['_token']));
    }

    public function delete($id){
        return $this->masterClassMaterialService->delete($id);
    }
}
