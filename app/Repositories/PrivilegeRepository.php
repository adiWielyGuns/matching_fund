<?php

namespace App\Repositories;

use App\Interfaces\PrivilegeRepositoryInterface;
use App\Models\Privilege;

class PrivilegeRepository implements PrivilegeRepositoryInterface
{
    public function getAllPrivileges()
    {
        return Privilege::all();
    }

    public function getPrivilegeById($orderId)
    {
        return Privilege::findOrFail($orderId);
    }

    public function deletePrivilege($orderId)
    {
        Privilege::destroy($orderId);
    }

    public function createPrivilege(array $orderDetails)
    {
        return Privilege::create($orderDetails);
    }

    public function updatePrivilege($orderId, array $newDetails)
    {
        return Privilege::whereId($orderId)->update($newDetails);
    }

    public function getIdPrivilege()
    {
        return Privilege::max('id') + 1;
    }

    public function getPrivilegeWithEloquent($condition, $relation)
    {
        return Privilege::with($relation)->get();
    }
}
