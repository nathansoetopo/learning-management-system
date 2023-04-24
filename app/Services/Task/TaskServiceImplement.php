<?php

namespace App\Services\Task;

use LaravelEasyRepository\Service;
use App\Repositories\Task\TaskRepository;

class TaskServiceImplement extends Service implements TaskService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(TaskRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAll()
    {
      return $this->mainRepository->getAll();
    }

    public function store($request)
    {
      return $this->mainRepository->store([
        'master_class_material_id' => $request->master_material_id,
        'class_id' => $request->class_id,
        'name' => $request->name,
        'description' => $request->description ?? 'Tidak Ada Deskripsi Soal',
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'closed' => $request->closed ? true : false,
      ]);
    }
}
