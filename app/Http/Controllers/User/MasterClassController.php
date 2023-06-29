<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Event;
use App\Models\MasterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\MasterClass\MasterClassService;

class MasterClassController extends Controller
{
    private $masterClassService;

    public function __construct(MasterClassService $masterClassService)
    {
        $this->masterClassService = $masterClassService;
    }

    public function index(Request $request)
    {
        $dashboard = $request->active_dashboard ?? false;

        $masterClasses = $this->masterClassService->getAll($request->all());

        if ($request->ajax()) {
            return response()->json([
                'view' => view('landing_page.components.master-class-card', compact('masterClasses'))->render(),
                'url' => $masterClasses->nextPageUrl()
            ]);
        }

        $events = Event::where('status', 'active')->get();

        return view('landing_page.master-class.index', compact('masterClasses', 'events', 'dashboard'));
    }

    public function forAffiliate(Request $request)
    {
        $masterClasses = $this->masterClassService->getAll([
            'paginate' => 9,
        ]);

        return view('landing_page.master-class.redeem-list', compact('masterClasses', 'request'));
    }

    public function show($id)
    {
        $masterClass = $this->masterClassService->find($id);

        $relatedMasterClasses = $this->masterClassService->getAll([
            'event_id' => $masterClass->event_id
        ]);

        // Rapiin
        $rate = DB::table('master_class_reviews')->select([
            'master_class_reviews.rate as rate',
            DB::raw('COUNT(rate) as reviewer')
        ])
        ->where('master_class_reviews.master_class_id', $id)
        ->groupBy('rate')
        ->orderBy('rate', 'ASC')
        ->get();

        $avg = $rate->avg('rate');

        return view('landing_page.master-class.detail', compact('masterClass', 'relatedMasterClasses', 'rate', 'avg'));
    }

    public function storeCart($id)
    {
        $masterClass = MasterClass::withCount(['cart' => function ($cart) {
            $cart->where('id', Auth::user()->id);
        }])->find($id);

        try {
            if ($masterClass->cart_count == 0) {
                $masterClass->cart()->attach(Auth::user()->id);
                $status = 'attached';
            } else {
                $masterClass->cart()->detach(Auth::user()->id);
                $status = 'detached';
            }

            return response()->json([
                'status' => 200,
                'data' => $status
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function storeWishlist($id)
    {
        $masterClass = MasterClass::withCount(['wishlist' => function ($wishlist) {
            $wishlist->where('id', Auth::user()->id);
        }])->find($id);

        try {
            if ($masterClass->wishlist_count == 0) {
                $status = 'attached';
                $masterClass->wishlist()->attach(Auth::user()->id);
            } else {
                $status = 'detached';
                $masterClass->wishlist()->detach(Auth::user()->id);
            }

            return response()->json([
                'status' => 200,
                'data' => $status
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => $e->getMessage()
            ]);
        }
    }
}
