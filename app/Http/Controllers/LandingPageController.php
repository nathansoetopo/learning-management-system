<?php

namespace App\Http\Controllers;

use App\Services\Event\EventService;
use App\Services\MasterClass\MasterClassService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    protected $masterClassService;
    protected $eventService;

    public function __construct(MasterClassService $masterClassService, EventService $eventService)
    {
        $this->masterClassService = $masterClassService;
        $this->eventService = $eventService;
    }

    public function index(){
        $masterClasses = $this->masterClassService->getAll([
            'paginate' => 12
        ]);

        $events = $this->eventService->getAll([
            'paginate' => 6
        ]);

        $upcoming = $this->masterClassService->getUpcoming([
            'paginate' => 4
        ]);

        return view('landing_page.index', compact('masterClasses', 'events', 'upcoming'));
    }
}
