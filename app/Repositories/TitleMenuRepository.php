<?php

namespace App\Repositories;

use App\Interfaces\TitleMenuRepositoryInterface;
use App\Models\TitleMenu;

class TitleMenuRepository implements TitleMenuRepositoryInterface
{
    public function getAllTitleMenus()
    {
        return TitleMenu::all();
    }

    public function getTitleMenuById($orderId)
    {
        return TitleMenu::findOrFail($orderId);
    }

    public function deleteTitleMenu($orderId)
    {
        TitleMenu::destroy($orderId);
    }

    public function createTitleMenu(array $orderDetails)
    {
        return TitleMenu::create($orderDetails);
    }

    public function updateTitleMenu($orderId, array $newDetails)
    {
        return TitleMenu::whereId($orderId)->update($newDetails);
    }

    public function getIdTitleMenu()
    {
        return TitleMenu::max('id') + 1;
    }

    public function getTitleMenuWithEloquent($condition, $relation)
    {
        return TitleMenu::max('id') + 1;
    }
}
