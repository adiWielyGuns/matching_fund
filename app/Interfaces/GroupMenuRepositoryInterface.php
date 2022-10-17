<?php

namespace App\Interfaces;

interface GroupMenuRepositoryInterface
{
    public function getAllGroupMenus();
    public function getIdGroupMenu();
    public function getGroupMenuById($titleMenuId);
    public function deleteGroupMenu($titleMenuId);
    public function createGroupMenu(array $titleMenuDetails);
    public function updateGroupMenu($titleMenuId, array $newDetails);
    public function getGroupMenuWithEloquent($condition, $relation);
}
