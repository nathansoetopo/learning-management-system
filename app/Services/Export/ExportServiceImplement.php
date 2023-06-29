<?php

namespace App\Services\Export;

use LaravelEasyRepository\Service;
use App\Repositories\Export\ExportRepository;

class ExportServiceImplement extends Service implements ExportService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ExportRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function transaction($request)
    {
      return $this->mainRepository->transaction($request);
    }
}
