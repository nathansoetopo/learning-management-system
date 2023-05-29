<?php

namespace App\Services\Certificate;

use LaravelEasyRepository\Service;
use App\Repositories\Certificate\CertificateRepository;

class CertificateServiceImplement extends Service implements CertificateService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CertificateRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function index()
    {
      return $this->mainRepository->index();
    }

    public function store($request)
    {
      return $this->mainRepository->store($request);
    }

    public function show($id)
    {
      return $this->mainRepository->show($id);
    }

    public function update($id, array $data)
    {
      return $this->mainRepository->update($id, $data);
    }

    public function delete($id)
    {
      return $this->mainRepository->delete($id);
    }
}
