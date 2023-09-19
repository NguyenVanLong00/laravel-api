<?php

namespace App\Http\Services;

use App\Enums\Token;
use App\Exceptions\Auth\UserExistedException;
use App\Exceptions\Auth\UserNotExistAppException;
use App\Exceptions\Auth\WrongPasswordAppException;
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
     * @throws UserNotExistAppException
     * @throws WrongPasswordAppException
     */
    public function login(string $username, string $password): NewAccessToken
    {
        $user = User::query()->where('email', $username)->first();

        if (!$user) {
            throw new UserNotExistAppException();
        }

        if (!Hash::check($password, $user->password)) {
            throw new WrongPasswordAppException();
        }

        return $user->createToken(Token::ACCESS_TOKEN->value);
    }

    /**
     * @param string $name
     * @param string $username
     * @param string $password
     * @return NewAccessToken
     * @throws UserExistedException
     */
    public function register(string $name,string $username, string $password): NewAccessToken
    {
        $userExisted = User::query()->where('email', $username)->exists();
        if ($userExisted){
            throw new UserExistedException();
        }

        $user = new User([
            'name' => $name,
            'email' => $username,
            'password' => Hash::make($password)
        ]);

        $user->save();

        return $user->createToken(Token::ACCESS_TOKEN->value);
    }
}
