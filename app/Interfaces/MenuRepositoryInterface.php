<?php

namespace App\Interfaces;

interface MenuRepositoryInterface
{
    public function getAllMenus();
    public function getIdMenu();
    public function getMenuById($titleMenuId);
    public function deleteMenu($titleMenuId);
    public function createMenu(array $titleMenuDetails);
    public function updateMenu($titleMenuId, array $newDetails);
    public function getMenuWithEloquent($condition, $relation);
}
