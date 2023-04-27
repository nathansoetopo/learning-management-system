<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitTask;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function show($id){
        $task = $this->taskService->getIndividualStudent($id);

        $info = $task->users->first()->pivot;

        return view('dashboard.mentee.class.submit', compact('task', 'info'));
    }

    public function submit($id, SubmitTask $request){
        $submit = $this->taskService->submit($id, $request);

        return $submit ? redirect()->route('mentee.class.show', ['id' => $submit->class_id])->with('success', 'Berhasil Submit Tugas') : redirect()->back()->withErrors('Submit Gagal Dilakukan');
    }
}
