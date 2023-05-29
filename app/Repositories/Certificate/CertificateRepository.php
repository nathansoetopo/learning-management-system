<?php

namespace App\Repositories\Certificate;

use LaravelEasyRepository\Repository;

interface CertificateRepository extends Repository{

    public function index();
    public function store($request);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}
