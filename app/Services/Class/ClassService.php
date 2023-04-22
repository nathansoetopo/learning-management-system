<?php

namespace App\Services\Class;

use LaravelEasyRepository\BaseService;

interface ClassService extends BaseService{

    public function getAll(array $request);
}
