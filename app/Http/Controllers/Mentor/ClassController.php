<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Services\Class\ClassService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    private $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(){
        $classes = $this->classService->getAll([
            'mentor_id' => Auth::user()->id
        ]);

        return view('dashboard.mentor.class.index', compact('classes'));
    }

    public function show($id){
        $class = $this->classService->show($id);

        return view('dashboard.mentor.class.detail', compact('class'));
    }
}
