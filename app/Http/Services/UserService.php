<?php

namespace App\Http\Services;

use App\Enums\Token;
use App\Exceptions\Auth\UserNotExistException;
use App\Exceptions\Auth\WrongPasswordException;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Http\Services\Interfaces\ToResource;
use App\Http\Services\Interfaces\Traits\Resource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class UserService extends Service implements ToResource
{
    use Resource;

    public function __construct()
    {
        parent::__construct();
    }

    public function resource(): string
    {
        return UserResource::class;
    }

    public function collection(): string
    {
        return UserCollection::class;
    }

    /**
     * @param string $username
     * @param string $password
     * @return NewAccessToken
     * @throws UserNotExistException
     * @throws WrongPasswordException
     */
    public function login(string $username, string $password) : NewAccessToken
    {
        $user = User::query()->where('email', $username)->first();

        if (!$user) {
            throw new UserNotExistException();
        }

        if (!Hash::check($password, $user->password)) {
            throw new WrongPasswordException();
        }

        return $user->createToken(Token::ACCESS_TOKEN->value);
    }
}
