<?php

namespace App\Services\TaskAsset;

use LaravelEasyRepository\BaseService;

interface TaskAssetService extends BaseService{

    public function get($id);
    public function delete($id);
    public function store($taskId, $request);
}
