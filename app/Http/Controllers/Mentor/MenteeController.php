<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class MenteeController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('class')->select('users.*', 'user_has_class.created_at as join')->where('responsible_id', Auth::user()->id)
            ->join('user_has_class', 'class.id', '=', 'user_has_class.class_id')
            ->join('users', 'user_has_class.user_id', '=', 'users.id');

        if ($request->class) {
            $users = $users->where('user_has_class.class_id', '=', $request->class);
        }

        $users = $users->distinct('users.id')->orderBy('join', 'desc')->get();

        if ($request->ajax()) {
            return view('dashboard.mentor.component.card-mentee', compact('users'))->render();
        }

        return view('dashboard.mentor.mentee.index', compact('users'));
    }

    public function activityLog($id){
        $user = DB::table('users')->where('id', $id)->first();
        $activites = Activity::where('causer_type', 'App\Models\User')->where('causer_id', $id)->orderBy('created_at', 'desc')->get();

        return view('dashboard.mentor.mentee.activity', compact('activites', 'user'));
    }
}
