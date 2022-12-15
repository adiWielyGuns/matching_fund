<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getIdUser();
    public function getUserById($titleMenuId);
    public function deleteUser($titleMenuId);
    public function createUser(array $titleMenuDetails);
    public function updateUser($userId, array $newDetails);
    public function getUserWithEloquent($relation);
}
