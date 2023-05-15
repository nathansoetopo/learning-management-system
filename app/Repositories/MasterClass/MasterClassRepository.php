<?php

namespace App\Repositories\MasterClass;

use LaravelEasyRepository\Repository;

interface MasterClassRepository extends Repository{

    public function getAll($request = null);
    public function store($request);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function getUpcoming($request);
}
