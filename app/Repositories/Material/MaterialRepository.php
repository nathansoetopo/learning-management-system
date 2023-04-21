<?php

namespace App\Repositories\Material;

use LaravelEasyRepository\Repository;

interface MaterialRepository extends Repository{

    public function store($request);
}
