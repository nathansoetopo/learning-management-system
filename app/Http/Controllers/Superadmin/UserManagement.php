<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    public function index(Request $request){
        $role = $request->role_name;
        $users = User::role($role)->get();

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

    public function changeStatus($role, $user_id){
        $data = User::find($user_id);

        $status = $data->status == 'active' ? 'inactive' : 'active';

        $data->update(['status' => $status]);

        return $status;
    }
}
