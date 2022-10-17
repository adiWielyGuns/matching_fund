<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::all();
    }

    public function getRoleById($orderId)
    {
        return Role::findOrFail($orderId);
    }

    public function deleteRole($orderId)
    {
        Role::destroy($orderId);
    }

    public function createRole(array $orderDetails)
    {
        return Role::create($orderDetails);
    }

    public function updateRole($orderId, array $newDetails)
    {
        return Role::whereId($orderId)->update($newDetails);
    }

    public function getIdRole()
    {
        return Role::max('id') + 1;
    }

    public function getRoleWithEloquent($condition, $relation)
    {
        return Role::with($relation)->get();
    }
}
