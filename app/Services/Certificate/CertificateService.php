<?php

namespace App\Services\Certificate;

use LaravelEasyRepository\BaseService;

interface CertificateService extends BaseService{

    public function index();
    public function store($request);
    public function show($id);
    public function attachDetach($request);
    public function update($id, array $data);
    public function delete($id);

}
