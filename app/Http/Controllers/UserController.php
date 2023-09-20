<?php

namespace App\Http\Controllers;


use App\Exceptions\Auth\UserExistedException;
use App\Exceptions\Auth\UserNotExistAppException;
use App\Exceptions\Auth\WrongPasswordAppException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\PaginatedResource;
use App\Http\Resources\User\PermissionResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {

        $users = $this->userService->users($request->query());

        return $this->response(data: [
            'users' => UserResource::collection($users->collect()),
            'paginate' => new PaginatedResource($users)
        ]);
    }

    public function create(CreateUserRequest $request)
    {
        $name = $request->get('name');
        $username = $request->get('username');
        $password = $request->get('password');
        $role = $request->get('role');

        $user = $this->userService->create($name, $username, $password, $role);

        return $this->response(
            data: [
                'user' => new UserResource($user)
            ],
            code: ResponseAlias::HTTP_CREATED
        );
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function permissions(Request $request): JsonResponse
    {
        return $this->response(
            data: [
                'permissions' => PermissionResource::collection(
                    $request->user()->getAllPermissions()
                )
            ],
        );
    }
}
