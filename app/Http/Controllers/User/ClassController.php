<?php

namespace App\Http\Controllers\User;

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
            'mentee_id' => Auth::user()->id
        ]);

        return view('landing_page.class.index', compact('classes'));
    }
}
