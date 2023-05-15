<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenteeController extends Controller
{
    public function index(Request $request){
        $users = DB::table('class')->select('users.*', 'user_has_class.created_at as join')->where('responsible_id', Auth::user()->id)
        ->join('user_has_class', 'class.id', '=', 'user_has_class.class_id')
        ->join('users', 'user_has_class.user_id', '=', 'users.id')
        ->distinct('users.id')->orderBy('join', 'desc')
        ->get();

        if($request->ajax()){
            return view('dashboard.mentor.component.card-mentee', compact('users'))->render();
        }

        return $users;
    }
}
