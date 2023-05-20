<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index($class_id){
        $students = User::whereHas('userHasClass', function($class) use ($class_id){
            $class->where('id', $class_id);
        })->with(['userHasClass' => function($class) use ($class_id){
            $class->where('id', $class_id);
        }])->get();

        $mentors = User::select(['name', 'email', 'id'])->whereHas('roles', function($role){
            $role->where('name', 'mentor');
        })->get();

        $users = User::select(['name', 'email', 'id'])->whereDoesntHave('userHasClass', function($class) use ($class_id){
            $class->where('id', $class_id);
        })->whereHas('roles', function($roles){
            $roles->whereIn('name', ['user', 'mentee', 'mentor']);
        })->get();

        $class = ClassModel::find($class_id);

        return view('dashboard.superadmin.student.index', compact('students', 'mentors', 'users', 'class'));
    }

    public function changeStatus($class_id, $user_id){
        $students = User::with('userHasClass')->find($user_id);

        $status = $students->userHasClass->first()->pivot->status == 'active' ? 'inactive' : 'active';

        $students->userHasClass()->updateExistingPivot($class_id, ['status' => $status]);

        return $status;
    }

    public function delete($class_id, $user_id){
        $students = User::find($user_id)->userHasClass()->detach($class_id);

        return $students ? true : false;
    }

    public function addStudents(Request $request, $class_id, $master_class_id){
        $unserializeData = [];
        $mentee = [];

        parse_str($request->get('data'), $unserializeData);

        DB::beginTransaction();
        try{
            for ($i=0; $i < count($unserializeData['mentee']); $i++) { 
                $user = User::find($unserializeData['mentee'][$i]);
                
                if(!empty($user)){
                    $user->userHasClass()->attach($class_id, ['master_class_id' => $master_class_id]);
                    array_push($mentee, [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'date' => day(Carbon::now()),
                        'gender' => $user->gender,
                        'class' => $class_id
                    ]);
                }
                
            }
            DB::commit();

            return response()->json([
                'status' => 200,
                'data' => $mentee
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'data' => $e->getMessage()
            ]);
        }
    }
}
