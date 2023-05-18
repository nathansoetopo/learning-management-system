<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PresenceStoreRequest;
use App\Http\Requests\PresenceUpdateRequest;
use App\Http\Resources\PresenceResource;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use App\Services\Presence\PresenceService;

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
}
