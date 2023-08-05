<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\MasterClassMaterial;
use App\Models\Material;
use App\Models\Score;
use App\Models\User;
use Exception;
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

    public function input($class_id, $id, $user_id){
        $user = User::find($user_id);
        // Get Auto Generate Score Mentee From Task
        $data = DB::table('master_class_material')->select([
            'master_class_material.name AS master_name',
            'master_class_material.id AS master_id',
            'user_has_tasks.master_class_material_id as material_id',
            DB::raw("AVG(user_has_tasks.score) AS task_score"),
        ])->where('master_class_id', $id)
        ->join('user_has_tasks', 'master_class_material.id', '=', 'user_has_tasks.master_class_material_id')->where('user_has_tasks.user_id', '=', $user_id)
        ->groupBy('master_id', 'material_id')
        ->get();

        $materials = MasterClassMaterial::where('master_class_id', $id)->getScoreByUser($user_id)->get();

        return view('dashboard.mentor.scoring.input', compact('data', 'materials', 'class_id', 'user_id', 'user', 'id'));
    }

    public function store(Request $request){
        try{
            $data = Score::where('class_id', $request->class_id)->where('user_id', $request->user_id)->where('master_class_material_id', $request->material_id)->first();

            $arr = [
                'class_id' => $request->class_id,
                'user_id' => $request->user_id,
                'master_class_material_id' => $request->material_id,
                'average' => $request->score,
                'predicate' => getPredicate($request->score)
            ];

            if(!empty($data)){
                $data->update($arr);
            }else{
                $data = Score::create($arr);
            }

            return response()->json(['status' => 200, 'data' => $data]);
        }catch(Exception $e){
            return response()->json(['status' => 500, 'data' => $e->getMessage()]);
        }
    }
}
