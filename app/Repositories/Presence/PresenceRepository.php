<?php

namespace App\Repositories\Presence;

use LaravelEasyRepository\Repository;

interface PresenceRepository extends Repository{
    public function index($request = null);
    public function store($request);
    public function show($id);
    public function update($id, $request);
    public function delete($id);
}
