<?php

namespace App\Services\Material;

use LaravelEasyRepository\Service;
use App\Repositories\Material\MaterialRepository;
use Illuminate\Support\Facades\Auth;

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

  public function store($id, $request)
  {
    if ($request->hasFile('asset')) {
      $type = $request->file('asset')->getClientOriginalExtension();

      if ($type == 'doc' || $type == 'docx' || $type == 'pdf') {
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
      'responsible_id' => Auth::user()->id,
      'name' => $request->name,
      'description' => $request->description,
      'type' => $type,
      'asset' => $asset
    ];

    return $this->mainRepository->store($data);
  }
}
