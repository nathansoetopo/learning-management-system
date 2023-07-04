<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubMaterialStoreRequest;
use App\Http\Requests\TaskAssetStore;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUPdateRequest;
use App\Http\Resources\MentorTaskResource;
use App\Http\Resources\TasksResouce;
use App\Models\Task;
use App\Services\Task\TaskService;
use App\Services\TaskAsset\TaskAssetService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private $taskService;
    private $uerService;
    private $taskAssetService;

    public function __construct(TaskService $taskService, UserService $userService, TaskAssetService $taskAssetService)
    {
        $this->taskService = $taskService;
        $this->uerService = $userService;
        $this->taskAssetService = $taskAssetService;
    }

    public function index(Request $request){
        $tasks = $this->taskService->getAll($request->all());

        if($request->ajax()){
            return MentorTaskResource::collection($tasks);
        }

        return view('dashboard.mentor.tasks.index', compact('tasks'));
    }

    public function create(){
        $classes = $this->uerService->getProfile(Auth::user()->id);

        $classes = $classes->mentor;

        return view('dashboard.mentor.tasks.create', compact('classes'));
    }

    public function store(TaskStoreRequest $request){
        $this->taskService->store($request);

        return redirect()->route('mentor.tasks.index')->with('success', 'Tugas Berhasil Disimpan');
    }

    public function delete($id){
        return $this->taskService->delete($id);
    }

    public function edit($id){
        $classes = $this->uerService->getProfile(Auth::user()->id);
        $classes = $classes->mentor;

        $task = $this->taskService->show($id);

        return view('dashboard.mentor.tasks.edit', compact('task', 'classes'));
    }

    public function update($id, TaskUPdateRequest $request){
        $this->taskService->update($id, $request);

        return redirect()->route('mentor.tasks.index')->with('success', 'Tugas Berhasil Diupdate');
    }

    public function getAsset($task_id){
        $data = $this->taskAssetService->get($task_id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function deleteAsset($id){
        return $this->taskAssetService->delete($id);
    }

    public function storeAsset($taskId, TaskAssetStore $request){
        $this->taskAssetService->store($taskId, $request);

        return redirect()->back()->with('success', 'Asset '.$request->name.' Berhasil Ditambahkan');
    }

    public function evaluation($id){
        $task = $this->taskService->show($id);

        return view('dashboard.mentor.tasks.evaluation', compact('task'));
    }

    public function scoring($id, Request $request){
        $task = Task::find($id);

        $request->score != null ? $task->users()->updateExistingPivot($request->user_id, ['score' => $request->score, 'status' => 'done']) : false;

        return $task;
    }
}
