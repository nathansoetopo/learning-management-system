<?php

namespace App\Services\Task;

use Carbon\Carbon;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

    public function getAll($request = null)
    {
      return $this->mainRepository->getAll($request);
    }

    public function show($id){
      return $this->mainRepository->show($id);
    }

    public function getIndividualStudent($id){
      return $this->mainRepository->getIndividualStudent($id);
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

    public function update($id, $request)
    {
      return $this->mainRepository->update($id, [
        'name' => $request->name,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'closed' => $request->closed ? true : false,
      ]);
    }

    public function delete($id)
    {
      return $this->mainRepository->delete($id);
    }

    public function submit($id, $request)
    {
      $get = $this->mainRepository->getIndividualStudent($id);

      if($get->closed == true && $get->end_date <= Carbon::now()){
        return redirect()->back()->withErrors('Pengumpulan Melebihi Batas Waktu');
      }

      if($get->users->first()->pivot->url != null){

        $url = parseUrl($get->users->first()->pivot->url);

        if (File::exists($url)) {
          File::delete($url);
        }

      }

      $asset = $request->file('asset')->store('tasks/student_'.Auth::user()->email);

      $request = [
        'url' => asset('storage/'.$asset),
        'submit_date' => Carbon::now(),
        'status' => 'submit'
      ];

      return $this->mainRepository->submit($id, $request);
    }

    public function getAllTaskStudent(){
      return $this->mainRepository->getAllTaskStudent();
    }
}
