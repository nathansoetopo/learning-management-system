<?php

namespace App\Repositories\Material;

use LaravelEasyRepository\Repository;

interface MaterialRepository extends Repository{

    public function store($request);
    public function show($id);
    public function update($id, $request);
    public function delete($id);
}
