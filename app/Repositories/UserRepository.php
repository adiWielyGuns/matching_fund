<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($orderId)
    {
        return User::findOrFail($orderId);
    }

    public function deleteUser($orderId)
    {
        User::destroy($orderId);
    }

    public function createUser(array $orderDetails)
    {
        return User::create($orderDetails);
    }

    public function updateUser($orderId, array $newDetails)
    {
        return User::whereId($orderId)->update($newDetails);
    }

    public function getIdUser()
    {
        return User::max('id') + 1;
    }

    public function getUserWithEloquent($relation)
    {
        return User::with($relation)->get();
    }
}
