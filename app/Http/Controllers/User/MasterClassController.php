<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\MasterClass\MasterClassService;
use Illuminate\Http\Request;

class MasterClassController extends Controller
{
    private $masterClassService;

    public function __construct(MasterClassService $masterClassService)
    {
        $this->masterClassService = $masterClassService;
    }

    public function index(Request $request){
        $masterClasses = $this->masterClassService->getAll([
            'paginate' => 9,
            'dashboard' => $request->active_dashboard ?? 1
        ]);

        return view('landing_page.master-class.index', compact('masterClasses'));
    }

    public function show($id){
        $masterClass = $this->masterClassService->find($id);

        $relatedMasterClasses = $this->masterClassService->getAll([
            'paginate' => 9,
            'event_id' => $masterClass->event_id
        ]);

        return view('landing_page.master-class.detail', compact('masterClass', 'relatedMasterClasses'));
    }
}
