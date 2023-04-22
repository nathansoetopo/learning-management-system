<?php

namespace App\Repositories\EventRepositories;

use LaravelEasyRepository\Repository;

interface EventRepositoriesRepository extends Repository{

    public function getAll();
    public function find($id);
    public function store($request);
    public function updateData($id, $request);
    public function deleteData($id);
}
