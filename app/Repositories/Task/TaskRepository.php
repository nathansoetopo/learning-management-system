<?php

namespace App\Repositories\Task;

use LaravelEasyRepository\Repository;

interface TaskRepository extends Repository{

    public function getAll();
    public function store($request);
}
