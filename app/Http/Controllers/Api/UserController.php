<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:sanctum');
    }

    public function show()
    {
        $user = $this->userService->getUserProfile(Auth::id());
        return response()->json($user);
    }

    public function update(UserRequest $request)
    {
        $user = $this->userService->updateUserProfile(Auth::id(), $request->validated());
        return response()->json($user);
    }
}