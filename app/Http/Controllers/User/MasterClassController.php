<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
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
        $dashboard = $request->active_dashboard ?? false;

        $masterClasses = $this->masterClassService->getAll($request->all());

        if($request->ajax()){
            return response()->json([
                'view' => view('landing_page.components.master-class-card', compact('masterClasses'))->render(),
                'url' => $masterClasses->nextPageUrl()
            ]);
        }

        $events = Event::where('status', 'active')->get();

        return view('landing_page.master-class.index', compact('masterClasses', 'events', 'dashboard'));
    }

    public function forAffiliate(Request $request){
        $masterClasses = $this->masterClassService->getAll([
            'paginate' => 9,
        ]);

        return view('landing_page.master-class.redeem-list', compact('masterClasses', 'request'));
    }

    public function show($id){
        $masterClass = $this->masterClassService->find($id);

        $relatedMasterClasses = $this->masterClassService->getAll([
            'event_id' => $masterClass->event_id
        ]);

        return view('landing_page.master-class.detail', compact('masterClass', 'relatedMasterClasses'));
    }
}
