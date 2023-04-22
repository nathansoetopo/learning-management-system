<?php

namespace App\Services\MasterClass;

use LaravelEasyRepository\BaseService;

interface MasterClassService extends BaseService{

    public function getAll($request = null);
    public function store($request);
    public function updateData($id, $request);
    public function find($id);
    public function changeStatus($id);
    public function delete($id);
    public function getUpcoming();
}
