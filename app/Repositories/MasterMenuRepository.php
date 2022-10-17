<?php

namespace App\Repositories;

use App\Interfaces\MasterMenuRepositoryInterface;
use App\Models\MasterMenu;

class MasterMenuRepository implements MasterMenuRepositoryInterface
{
    public function getAllMasterMenus()
    {
        return MasterMenu::all();
    }

    public function getMasterMenuById($orderId)
    {
        return MasterMenu::findOrFail($orderId);
    }

    public function deleteMasterMenu($orderId)
    {
        MasterMenu::destroy($orderId);
    }

    public function createMasterMenu(array $orderDetails)
    {
        return MasterMenu::create($orderDetails);
    }

    public function updateMasterMenu($orderId, array $newDetails)
    {
        return MasterMenu::whereId($orderId)->update($newDetails);
    }

    public function getIdMasterMenu()
    {
        return MasterMenu::max('id') + 1;
    }

    public function getMasterMenuWithEloquent($condition, $relation)
    {
        return MasterMenu::with($relation)->get();
    }
}
