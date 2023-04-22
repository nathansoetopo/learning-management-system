<?php

namespace App\Services\Class;

use LaravelEasyRepository\Service;
use App\Repositories\Class\ClassRepository;

class ClassServiceImplement extends Service implements ClassService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ClassRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAll(array $request)
    {
      return $this->mainRepository->getAll($request);
    }
}
