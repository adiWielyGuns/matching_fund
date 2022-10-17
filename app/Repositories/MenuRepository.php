<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAllMenus()
    {
        return Menu::all();
    }

    public function getMenuById($orderId)
    {
        return Menu::findOrFail($orderId);
    }

    public function deleteMenu($orderId)
    {
        Menu::destroy($orderId);
    }

    public function createMenu(array $orderDetails)
    {
        return Menu::create($orderDetails);
    }

    public function updateMenu($orderId, array $newDetails)
    {
        return Menu::whereId($orderId)->update($newDetails);
    }

    public function getIdMenu()
    {
        return Menu::max('id') + 1;
    }

    public function getMenuWithEloquent($condition, $relation)
    {
        return Menu::with($relation)->get();
    }
}
