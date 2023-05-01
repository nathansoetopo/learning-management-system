<?php

namespace App\Repositories\Referal;

use LaravelEasyRepository\Repository;

interface ReferalRepository extends Repository{

    public function show($id);
    public function redeem($request);
}
