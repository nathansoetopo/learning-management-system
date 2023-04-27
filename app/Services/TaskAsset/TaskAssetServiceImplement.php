<?php

namespace App\Services\TaskAsset;

use LaravelEasyRepository\Service;
use App\Repositories\TaskAsset\TaskAssetRepository;

class TaskAssetServiceImplement extends Service implements TaskAssetService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(TaskAssetRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function get($id)
  {
    return $this->mainRepository->get($id);
  }

  public function delete($id)
  {
    return $this->mainRepository->delete($id);
  }

  public function store($taskId, $request)
  {
    if ($request->hasFile('asset')) {
      $type = $request->file('asset')->getClientOriginalExtension();

      if ($type == 'doc' || $type == 'docx' || $type == 'pdf' || $type == 'zip') {
        $type = 'file';
      } else if ($type == 'jpg' || $type == 'jpeg' || $type == 'png') {
        $type = 'image';
      }

      $store = $request->file('asset')->store('task_asset');
      $asset = asset('storage/' . $store);
    } else if ($request->url != null) {
      $type = 'url';

      $asset = $request->url;
    } else {
      return redirect()->back()->withErrors('Asset dan url kosong');
    }

    $data = [
      'task_id' => $taskId,
      'name' => $request->name,
      'type' => $type,
      'url' => $asset
    ];

    return $this->mainRepository->create($data);
  }
}
