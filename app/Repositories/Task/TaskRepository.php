<?php

namespace App\Repositories\Task;

use LaravelEasyRepository\Repository;

interface TaskRepository extends Repository{

    public function getAll();
    public function show($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
    public function submit($id, $request);
    public function getIndividualStudent($id);
}
