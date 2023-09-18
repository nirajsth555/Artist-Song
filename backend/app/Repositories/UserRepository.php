<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data)
    {
        try {
            $user = $this->user->create([
                'first_name' => $data['firstName'],
                'last_name' => $data['lastName'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'role' => $data['role']
            ]);
            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findUserByEmail($email)
    {
        try {
            $user = $this->user->where('email', $email)->first();
            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
