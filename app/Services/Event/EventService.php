<?php

namespace App\Services\Event;

use LaravelEasyRepository\BaseService;

interface EventService extends BaseService{

    public function getAll();
    public function find($id);
    public function updateData($id, $request);
    public function deleteData($id);
    public function store($request);
    public function changeStatus($id);
}
