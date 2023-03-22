<?php

namespace App\Services\MasterClass;

use LaravelEasyRepository\Service;
use App\Repositories\MasterClass\MasterClassRepository;

class MasterClassServiceImplement extends Service implements MasterClassService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(MasterClassRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAll($request = null)
    {
      return $this->mainRepository->getAll($request = null);
    }
}
