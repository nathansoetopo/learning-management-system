<?php

namespace App\Services\MasterClass;

use Illuminate\Support\Str;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\File;
use App\Repositories\MasterClass\MasterClassRepository;

class MasterClassServiceImplement extends Service implements MasterClassService
{

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
    return $this->mainRepository->getAll($request);
  }

  public function store($request)
  {
    $image = $request->file('image')->store('master_class_thumbnail');

    $arr = [
      'event_id' => $request->event_id,
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'price' => $request->price,
      'image' => asset('storage/' . $image),
      'active_dashboard' => $request->dashboard  ? true : false,
      'status' => 'active'
    ];

    return $this->mainRepository->store($arr);
  }

  public function updateData($id, $request)
  {
    $find = $this->mainRepository->find($id);

    $image = $find->image;

    if ($request->hasFile('image')) {
      $url = parseUrl($request['image']);

      if (File::exists($url)) {
        File::delete($url);
      }

      $image = request()->file('image')->store('master_class_thumbnail');
      $image = asset('storage/' . $image);
    }

    return $this->mainRepository->update($id, [
      'event_id' => $request->event_id,
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'price' => $request->price,
      'image' => $image,
      'active_dashboard' => $request->dashboard  ? true : false,
    ]);
  }

  public function find($id)
  {
    return $this->mainRepository->find($id);
  }

  public function changeStatus($id)
  {
    $data = $this->mainRepository->find($id);

    $status = $data->status == 'active' ? 'inactive' : 'active';

    $this->mainRepository->update($id, ['status' => $status]) ? true : false;
  }

  public function delete($id)
  {
    $data = $this->mainRepository->find($id);

    if (File::exists($data->image)) {
      File::delete($data->image);
    }

    return $this->mainRepository->delete($id);
  }

  public function getUpcoming()
  {
    return $this->mainRepository->getUpcoming();
  }
}
