<?php

namespace App\Repositories\MasterClass;

use LaravelEasyRepository\Repository;

interface MasterClassRepository extends Repository{

    public function getAll($request = null);
}
