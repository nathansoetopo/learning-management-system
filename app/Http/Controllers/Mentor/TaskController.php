<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Services\Task\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private $taskService;
    private $uerService;

    public function __construct(TaskService $taskService, UserService $userService)
    {
        $this->taskService = $taskService;
        $this->uerService = $userService;
    }

    public function index(){
        $tasks = $this->taskService->getAll();

        return view('dashboard.mentor.tasks.index', compact('tasks'));
    }

    public function create(){
        $classes = $this->uerService->getProfile(Auth::user()->id);

        $classes = $classes->mentor;

        return view('dashboard.mentor.tasks.create', compact('classes'));
    }

    public function store(TaskStoreRequest $request){
        return $request;
        $this->taskService->store($request);

        return redirect()->route('mentor.tasks.index')->with('success', 'Tugas Berhasil Disimpan');
    }
}
