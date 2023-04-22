<?php

namespace App\Services\Material;

use LaravelEasyRepository\BaseService;

interface MaterialService extends BaseService{

    public function store($id, $request);
    public function show($id);
    public function update($id, $request);
    public function delete($id);
}
