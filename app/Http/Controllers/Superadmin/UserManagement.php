<?php

namespace App\Http\Controllers\Superadmin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Spatie\Activitylog\Models\Activity;

class UserManagement extends Controller
{
    public function index(Request $request){
        $role = $request->role_name;
        $users = User::role($role)->get();

        if($request->ajax()){
            return response()->json([
                'status'    => 200,
                'data'      => UserResource::collection($users)
            ]);
        }

        return view('dashboard.superadmin.user-management.superadmin.index', compact('users', 'role'));
    }

    public function create(Request $request){
        $role = $request->role_name;

        return view('dashboard.superadmin.user-management.superadmin.create', compact('role'));
    }

    public function store($role, RegisterRequest $request){

        DB::beginTransaction();

        try{
            $data = $request->except(['_token', 'password_confirmation']);

            $data['avatar']             = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRceeoCvxzs1sp0cKRtwCyzr9LvG3ceMP0OGg&usqp=CAU';
            $data['password']           = Hash::make($data['password']);
            $data['email_verified_at']  = Carbon::now();
    
            $user = User::create($data);
    
            $user->assignRole($role);
    
            DB::commit();
            return redirect()->route('superadmin.manage.users', ['role_name' => $role])->with('success', 'Berhasil Menambahkan '.$user->name.' Sebagai '.$role);
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('superadmin.manage.users', ['role_name' => $role])->with('danger', 'Gagal Menambahkan '.$request->name.' Sebagai '.$role);
        }
    }

    public function attach($role, Request $request){
       DB::beginTransaction(); 
        try{
            foreach($request->user_id as $user_id){
                $user = User::find($user_id);
    
                $user->assignRole($role);
            }
            DB::commit();
            return 200;
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

    }

    public function changeStatus($role, $user_id){
        $data = User::role($role)->find($user_id);

        $status = $data->status == 'active' ? 'inactive' : 'active';

        if($data->hasRole('superadmin') && $status == 'inactive'){
            $count = User::where('status', 'active')->role('superadmin')->get();

            if($count->count() < 2){
                return false;
            }
        }

        $data->update(['status' => $status]);

        return $status;
    }

    public function activity_log($email){
        $find = User::where('email', $email)->first();

        $activites = Activity::where('causer_type', 'App\Models\User')->where('causer_id', $find->id)->orderBy('created_at', 'desc')->get();

        return view('dashboard.superadmin.user-management.superadmin.activity', compact('activites'));
    }
}
