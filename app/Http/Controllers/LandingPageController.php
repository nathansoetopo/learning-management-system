<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\MasterClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Event\EventService;
use App\Services\MasterClass\MasterClassService;

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
        $masterClasses = MasterClass::where('status', 'active')->orderBy('created_at', 'desc')->get()->take(6);

        $events = $this->eventService->getAll([
            'paginate' => 6
        ]);

        $upcoming = $this->masterClassService->getUpcoming([
            'paginate' => 4
        ]);

        $mentors = User::role('mentor')->get();

        $blogs = Blog::with('categories')->orderBy('created_at', 'desc')->get()->take(3);

        return view('landing_page.index', compact('masterClasses', 'events', 'upcoming', 'mentors', 'blogs'));
    }

    public function getUser(Request $request){
        $role = $request->role_name;
        $users = User::role($role)->get();

        return $users;
    }
}
