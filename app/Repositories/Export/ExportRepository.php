<?php

namespace App\Repositories\Export;

use LaravelEasyRepository\Repository;

interface ExportRepository extends Repository{

    public function transaction($request);
}
