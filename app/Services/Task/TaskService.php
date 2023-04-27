<?php

namespace App\Services\Task;

use LaravelEasyRepository\BaseService;

interface TaskService extends BaseService{

    public function getAll();
    public function show($id);
    public function getIndividualStudent($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
    public function submit($id, $request);
}
