<?php

namespace App\Repositories\Referal;

use LaravelEasyRepository\Repository;

interface ReferalRepository extends Repository{

    public function index();
    public function detail($id);
    public function show($id);
    public function redeem($request);
}
