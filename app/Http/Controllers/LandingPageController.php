<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\MasterClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Event\EventService;
use App\Services\MasterClass\MasterClassService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $vouchers_master_class = DB::table('master_class_has_voucher')
        ->select([
            'master_class.*',
            'vouchers.start_date as start_voucher',
            'vouchers.end_date as end_voucher',
            'vouchers.nominal as voucher_nominal',
            'vouchers.discount_type as voucher_discount'
        ])
        ->join('master_class', 'master_class_has_voucher.master_class_id', '=', 'master_class.id')
        ->join('vouchers', 'master_class_has_voucher.voucher_id', '=', 'vouchers.id')
        ->where('vouchers.start_date', '<=', Carbon::now())->where('vouchers.end_date', '>=', Carbon::now())
        ->get();

        $masterClasses = MasterClass::where('status', 'active')->orderBy('created_at', 'desc')->get()->take(6);

        $events = $this->eventService->getAll([
            'paginate' => 6
        ]);

        $upcoming = $this->masterClassService->getUpcoming([
            'paginate' => 4
        ]);

        $mentors = User::role('mentor')->get();

        $blogs = Blog::with('categories')->orderBy('created_at', 'desc')->get()->take(3);

        return view('landing_page.index', compact('masterClasses', 'events', 'upcoming', 'mentors', 'blogs', 'vouchers_master_class'));
    }

    public function getUser(Request $request){
        $role = $request->role_name;
        $users = User::role($role)->get();

        return $users;
    }
}
