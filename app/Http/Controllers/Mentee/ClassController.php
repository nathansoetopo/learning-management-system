<?php

namespace App\Http\Controllers\Mentee;

use Carbon\Carbon;
use App\Models\Presence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Services\Class\ClassService;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    private $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(){
        $classes = $this->classService->getAll(['mentee_id' => Auth::user()->id]);
        return view('dashboard.mentee.class.index' ,compact('classes'));
    }

    public function show($classId){
        $presences = Presence::whereHas('users', function($users){
            $users->where('id', Auth::user()->id);
        })->with(['users' => function($user){
            $user->where('id', Auth::user()->id)->wherePivot('status', 'undone');
        }, 'class'])->where('open_clock', '<=', Carbon::now())->get();

        $certificate = Certificate::whereHas('user', function($user){
            $user->where('id', Auth::user()->id);
        })->whereHas('class', function($class) use ($classId){
            $class->where('id', $classId);
        })->first();

        $class = $this->classService->show($classId);

        return $class->masterClass->active_dashboard ? view('dashboard.mentee.class.detail', compact('class', 'certificate')) : view('dashboard.mentee.class.webinar', compact('class', 'presences', 'certificate'));

        return view('dashboard.mentee.class.detail', compact('class'));
    }
}
