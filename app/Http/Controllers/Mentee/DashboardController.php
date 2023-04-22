<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Services\Class\ClassService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(){
        $classes = $this->classService->getAll([
            'mentee_id' => Auth::user()->id,
            'paginate' => 9
        ]);

        return view('dashboard.mentee.dashboard', compact('classes'));
    }
}
