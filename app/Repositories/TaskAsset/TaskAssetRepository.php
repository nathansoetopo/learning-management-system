<?php

namespace App\Repositories\TaskAsset;

use LaravelEasyRepository\Repository;

interface TaskAssetRepository extends Repository{

    public function get($task_id);
    public function delete($id);
    public function store($request);
}
