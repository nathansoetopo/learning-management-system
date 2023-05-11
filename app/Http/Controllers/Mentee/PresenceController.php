<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Http\Resources\PresenceResource;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index(Request $request){
        $presences = Presence::whereHas('users', function($users){
            $users->where('id', Auth::user()->id);
        })->with(['users' => function($user){
            $user->where('id', Auth::user()->id)->wherePivot('status', 'undone');
        }, 'class'])->where('open_clock', '<=', Carbon::now())->where('closed_clock', '>=', Carbon::now())->get();

        if($request->ajax()){
            return PresenceResource::collection($presences);
        }

        return view('dashboard.mentee.presence.index', compact('presences'));
    }

    public function presence($id, Request $request){
        $presence = Presence::find($id);

        $presence->users()->updateExistingPivot(Auth::user()->id, [
            'description' => $request->description,
            'status' => 'submit'
        ]);

        return redirect()->back()->with('success', 'Berhasil Melakukan Presensi');
    }
}
