<?php

namespace App\Http\Controllers;


use App\Exceptions\Auth\UserNotExistException;
use App\Exceptions\Auth\WrongPasswordException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws UserNotExistException
     * @throws WrongPasswordException
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $username = $loginRequest->get('username');
        $password = $loginRequest->get('password');

        $token = $this->userService->login($username, $password);

        return $this->response(
            data: [
                'token' => $token
            ],
            message: "login success"
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return $this->response(message: "logout success");
    }
}
