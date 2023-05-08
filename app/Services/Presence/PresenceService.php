<?php

namespace App\Services\Presence;

use LaravelEasyRepository\BaseService;

interface PresenceService extends BaseService{
    public function index();
    public function store($request);
    public function show($id);
    public function update($id, $request);
    public function delete($id);
}
