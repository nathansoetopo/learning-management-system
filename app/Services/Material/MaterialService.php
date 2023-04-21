<?php

namespace App\Services\Material;

use LaravelEasyRepository\BaseService;

interface MaterialService extends BaseService{

    public function store($id, $request);
}
