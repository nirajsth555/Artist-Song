<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponser;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(CreateUserRequest $request)
    {
        try {
            $user = $this->userService->createUser($request->all());
            return $this->successResponse($user, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function login(Request $request)
    {
        try {
            $user = $this->userService->loginUser($request->all());
            return $this->generalisedResponse("Login Success", true, $user, Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
