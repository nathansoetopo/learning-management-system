<?php

namespace App\Services\Presence;

use LaravelEasyRepository\Service;
use App\Repositories\Presence\PresenceRepository;

class PresenceServiceImplement extends Service implements PresenceService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(PresenceRepository $mainRepository)
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

    public function update($id, $request)
    {
      return $this->mainRepository->update($id, $request);
    }

    public function delete($id)
    {
      return $this->mainRepository->delete($id);
    }
}
