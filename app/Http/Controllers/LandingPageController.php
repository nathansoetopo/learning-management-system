<?php

namespace App\Http\Controllers;

use App\Services\MasterClass\MasterClassService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    protected $masterClassService;

    public function __construct(MasterClassService $masterClassService)
    {
        $this->masterClassService = $masterClassService;
    }

    public function index(){
        $masterClasses = $this->masterClassService->getAll();

        return view('landing_page.index', compact('masterClasses'));
    }
}
