<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->create($data);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw ($e);
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function loginUser($data)
    {
        try {
            $user = $this->userRepository->findUserByEmail($data['email']);
            if (is_null($user)) {
                throw new GeneralException("User not found", Response::HTTP_NOT_FOUND);
            }
            if (!Hash::check($data['password'], $user->password)) {
                throw new GeneralException("Email or password mismatch", Response::HTTP_BAD_REQUEST);
            }
            $token = $user->createToken("API TOKEN")->plainTextToken;
            return [
                'token' => $token,
                'user' => $user
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
