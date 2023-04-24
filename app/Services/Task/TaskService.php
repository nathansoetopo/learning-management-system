<?php

namespace App\Services\Task;

use LaravelEasyRepository\BaseService;

interface TaskService extends BaseService{

    public function getAll();
    public function store($request);
}
