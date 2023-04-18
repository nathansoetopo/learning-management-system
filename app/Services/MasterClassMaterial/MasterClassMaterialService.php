<?php

namespace App\Services\MasterClassMaterial;

use LaravelEasyRepository\BaseService;

interface MasterClassMaterialService extends BaseService{

    public function create($request);
    public function show($request);
    public function update($id, $request);
    public function delete($id);
}
