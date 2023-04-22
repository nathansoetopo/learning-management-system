<?php

namespace App\Services\Event;

use Illuminate\Support\Str;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\File;
use App\Repositories\Event\EventRepository;
use App\Repositories\EventRepositories\EventRepositoriesRepository;

class EventServiceImplement extends Service implements EventService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(EventRepositoriesRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getAll()
  {
    return $this->mainRepository->getAll();
  }

  public function find($id)
  {
    return $this->mainRepository->find($id);
  }

  public function store($request)
  {
    $image = $request->file('image')->store('events_thumbnail');

    $arr = [
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'description' => $request->description,
      'image' => asset('storage/' . $image)
    ];

    return $this->mainRepository->store($arr);
  }

  public function updateData($id, $request)
  {
    $data = $this->mainRepository->find($id);

    $image = $data->image;

    if ($request->hasFile('image')) {
      $url = parseUrl($data->image);

      if (File::exists($url)) {
        File::delete($url);
      }

      $image = $request->file('image')->store('events_thumbnail');
      $image = asset('storage/' . $image);
    }

    $arr = [
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'description' => $request->description,
      'image' => $image
    ];

    return $this->mainRepository->updateData($id, $arr);
  }

  public function deleteData($id)
  {
    $data = $this->mainRepository->find($id);

    if (File::exists($data->image)) {
      File::delete($data->image);
    }

    return $this->mainRepository->deleteData($id);
  }

  public function changeStatus($id){
    $data = $this->mainRepository->find($id);

    $status = $data->status == 'active' ? 'inactive' : 'active';

    return $this->mainRepository->updateData($id, ['status' => $status]) ? true : false;
  }
}
