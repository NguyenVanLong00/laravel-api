<?php

namespace App\Http\Controllers;


use App\Exceptions\Auth\UserExistedException;
use App\Exceptions\Auth\UserNotExistAppException;
use App\Exceptions\Auth\WrongPasswordAppException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\RoleResource;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws UserNotExistAppException
     * @throws WrongPasswordAppException
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

    /**
     * @param RegisterRequest $registerRequest
     * @return JsonResponse
     * @throws UserExistedException
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $name = $registerRequest->get('name');
        $username = $registerRequest->get('username');
        $password = $registerRequest->get('password');


        $token = $this->userService->register($name, $username, $password);

        return $this->response(
            data: [
                'token' => $token
            ],
            message: "registered successful",
            code: ResponseAlias::HTTP_CREATED
        );
    }

    public function roles(Request $request){

        $roles =$request->user()->roles()->with('permissions')->get();

        return  $this->response(
            data: [
                'roles' => RoleResource::collection($roles)
            ],
        );
    }
}
