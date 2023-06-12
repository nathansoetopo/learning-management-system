<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        $user = $this->userService->getProfile(Auth::user()->id);

        return view('landing_page.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request){
        $update = $this->userService->update(Auth::user()->id, $request->except(['_token', '_method']));

        return $update;
    }
}
