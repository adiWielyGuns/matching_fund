<?php

namespace App\Repositories;

use App\Interfaces\GroupMenuRepositoryInterface;
use App\Models\GroupMenu;

class GroupMenuRepository implements GroupMenuRepositoryInterface
{
    public function getAllGroupMenus()
    {
        return GroupMenu::all();
    }

    public function getGroupMenuById($orderId)
    {
        return GroupMenu::findOrFail($orderId);
    }

    public function deleteGroupMenu($orderId)
    {
        GroupMenu::destroy($orderId);
    }

    public function createGroupMenu(array $orderDetails)
    {
        return GroupMenu::create($orderDetails);
    }

    public function updateGroupMenu($orderId, array $newDetails)
    {
        return GroupMenu::whereId($orderId)->update($newDetails);
    }

    public function getIdGroupMenu()
    {
        return GroupMenu::max('id') + 1;
    }

    public function getGroupMenuWithEloquent($condition, $relation)
    {
        return GroupMenu::max('id') + 1;
    }
}
