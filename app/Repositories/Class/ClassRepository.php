<?php

namespace App\Repositories\Class;

use LaravelEasyRepository\Repository;

interface ClassRepository extends Repository{

    public function getAll(array $request);
}
