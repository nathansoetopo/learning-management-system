<?php

namespace App\Services\Referal;

use LaravelEasyRepository\BaseService;

interface ReferalService extends BaseService{

    public function confirm($request);
}
