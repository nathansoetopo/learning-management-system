<?php

namespace App\Http\Controllers\Mentor;

use App\Models\Presence;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\PresenceResource;
use App\Services\Presence\PresenceService;
use App\Http\Requests\PresenceStoreRequest;
use App\Http\Requests\PresenceUpdateRequest;
use Illuminate\Support\Facades\DB;

class PresensceController extends Controller
{

    private $presenceService;
    private $userService;

    public function __construct(PresenceService $presenceService, UserService $userService)
    {
        $this->presenceService = $presenceService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $presences = $this->presenceService->index([
            'mentor_id' => Auth::user()->id,
            'class_id' => $request->class_id ?? null
        ]);

        if ($request->ajax()) {
            return PresenceResource::collection($presences);
        }

        return view('dashboard.mentor.presence.index', compact('presences'));
    }

    public function show($id)
    {
        $presence = $this->presenceService->show($id);

        return view('dashboard.mentor.presence.detail', compact('presence'));
    }

    public function create()
    {
        $classes = $this->userService->getProfile(Auth::user()->id);

        $classes = $classes->mentor;

        return view('dashboard.mentor.presence.created', compact('classes'));
    }

    public function store(PresenceStoreRequest $request)
    {
        $create = $this->presenceService->store($request->except(['_token']));

        return $create ? redirect()->route('mentor.presence.index')->with('success', 'Presensi Berhasil Dibuat') : redirect()->back()->withErrors('Presensi Gagal Dibuat');
    }

    public function edit($id)
    {
        $classes = $this->userService->getProfile(Auth::user()->id);

        $classes = $classes->mentor;

        $data = $this->presenceService->show($id);

        return view('dashboard.mentor.presence.edit', compact('data', 'classes'));
    }

    public function update($id, PresenceUpdateRequest $request)
    {
        $update = $this->presenceService->update($id, $request->except(['_token']));

        return $update ? redirect()->route('mentor.presence.index')->with('success', 'Presensi Berhasil Update') : redirect()->back()->withErrors('Presensi Gagal Update');
    }

    public function updateStatus($id, Request $request)
    {
        $presence = Presence::find($id);

        $presence->users()->updateExistingPivot($request->user_id, [
            'status' => $request->status
        ]);

        return $presence;
    }

    public function delete($id)
    {
        $delete = $this->presenceService->delete($id);

        return $delete ? ['status' => 'success', 'msg' => 'Presensi Berhasil Dihapus'] : ['status' => 'error', 'msg' => 'Presensi Gagal Dihapus'];
    }

    public function recap($user_id, $class_id){
        $data = DB::table('presence')->select('user_has_presence.status',DB::raw("COUNT(user_has_presence.user_id) AS presence_count"))
        ->join('user_has_presence', 'presence.id', '=', 'user_has_presence.presence_id')
        ->join('users', 'user_has_presence.user_id', '=', 'users.id')
        ->where('presence.class_id', $class_id)->where('users.id', $user_id)
        ->groupBy('user_has_presence.status')->get();

        $attendance = $data->where('status', 'done')->first();

        $total = $data->sum('presence_count');

        $result = $attendance->presence_count == 0 ? 0 : ($attendance->presence_count / $total) * 100;

        return response()->json([
            'status'    => 200,
            'result'    => $result,
            'data'      => view('dashboard.mentor.certificate.table', compact('data'))->render()
        ]);

        // $attendance = $data->where('user_has_presence.status', 'done')->get()->count();

        // $total = $data->get()->count();

        // $result = $attendance == 0 ? 0 : ($attendance / $total) * 100;

        // return $result;
    }
}
