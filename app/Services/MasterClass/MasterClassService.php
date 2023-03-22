<?php

namespace App\Services\MasterClass;

use LaravelEasyRepository\BaseService;

interface MasterClassService extends BaseService{

    public function getAll($request = null);
}
