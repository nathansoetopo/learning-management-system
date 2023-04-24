<?php

namespace App\Services\Material;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repositories\Material\MaterialRepository;

class MaterialServiceImplement extends Service implements MaterialService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(MaterialRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function store($classId, $id, $request)
  {
    if ($request->hasFile('asset')) {
      $type = $request->file('asset')->getClientOriginalExtension();

      if ($type == 'doc' || $type == 'docx' || $type == 'pdf' || $type == 'zip') {
        $type = 'file';
      } else if ($type == 'jpg' || $type == 'jpeg' || $type == 'png') {
        $type = 'image';
      }

      $store = $request->file('asset')->store('material');
      $asset = asset('storage/'.$store);

    }else if($request->url != null){
      $type = 'url';

      $asset = $request->url;

    }else{
      return redirect()->back()->withErrors('Asset dan url kosong');
    }

    $data = [
      'master_class_material_id' => $id,
      'class_id' => $classId,
      'responsible_id' => Auth::user()->id,
      'name' => $request->name,
      'description' => $request->description,
      'type' => $type,
      'asset' => $asset
    ];

    return $this->mainRepository->store($data);
  }

  public function show($id){
    return $this->mainRepository->show($id);
  }

  public function update($id, $request)
  {
    $data = $this->mainRepository->show($id);

    $asset = $data->asset;

    if($request->hasFile('asset')){
      $url = parseUrl($asset);

      if (File::exists($url)) {
        File::delete($url);
      }

      $type = $request->file('asset')->getClientOriginalExtension();

      if ($type == 'doc' || $type == 'docx' || $type == 'pdf' || $type == 'zip') {
        $type = 'file';
      } else if ($type == 'jpg' || $type == 'jpeg' || $type == 'png') {
        $type = 'image';
      }

      $asset = $request->file('asset')->store('material');
      $asset = asset('storage/'.$asset);
    }else if($request->url != null){
      $type = 'url';

      $asset = $request->url;
    }

    $data = [
      'name' => $request->name,
      'type' => $type,
      'asset' => $asset
    ];

    return $this->mainRepository->update($id, $data);
  }

  public function delete($id)
  {
    return $this->mainRepository->delete($id);
  }
}
