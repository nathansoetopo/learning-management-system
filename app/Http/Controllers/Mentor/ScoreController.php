<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    public function index(){
        $classes = ClassModel::whereHas('mentee')->with('masterClass')->where('responsible_id', Auth::user()->id)->get();

        return view('dashboard.mentor.scoring.index', compact('classes'));
    }

    public function mentee($id){
        $class = ClassModel::with('mentee')->find($id);

        return view('dashboard.mentor.scoring.mentee', compact('class'));
    }

    public function input($id, $user_id){
        $data = DB::table('master_class_material')->select('master_class_material.id', 'tasks.id', DB::raw("AVG(user_has_tasks.score) AS total_program_amount"))->where('master_class_id', $id)
        ->join('tasks', 'master_class_material.id', 'tasks.master_class_material_id')
        ->join('user_has_tasks', 'tasks.id', '=', 'user_has_tasks.task_id')->where('user_has_tasks.user_id', '=', $user_id)
        ->groupBy('tasks.id', 'user_has_tasks.task_id')
        ->get();

        return $data;

        // $data = DB::table('tasks')->select('tasks.id', DB::raw("AVG(user_has_tasks.score) AS total_program_amount"),)->where('class_id', $id)
        // ->join('user_has_tasks', 'tasks.id', '=', 'user_has_tasks.task_id')->where('user_has_tasks.user_id', '=', $user_id)
        // ->groupBy('tasks.id', 'user_has_tasks.task_id')
        // ->get();

        // return $data;
    }
}
