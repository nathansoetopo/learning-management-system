<?php

namespace App\Services\Referal;

use LaravelEasyRepository\BaseService;

interface ReferalService extends BaseService{
    public function index();
    public function detail($id);
    public function confirm($request);
}
