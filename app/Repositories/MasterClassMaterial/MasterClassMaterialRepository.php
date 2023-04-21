<?php

namespace App\Repositories\MasterClassMaterial;

use LaravelEasyRepository\Repository;

interface MasterClassMaterialRepository extends Repository{

    public function list($id);
    public function create($request);
    public function show($request);
    public function update($id, $request);
    public function delete($id);
}
