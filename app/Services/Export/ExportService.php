<?php

namespace App\Services\Export;

use LaravelEasyRepository\BaseService;

interface ExportService extends BaseService{

    public function transaction($request);
}
