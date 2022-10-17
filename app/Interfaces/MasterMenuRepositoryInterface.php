<?php

namespace App\Interfaces;

interface MasterMenuRepositoryInterface
{
    public function getAllMasterMenus();
    public function getIdMasterMenu();
    public function getMasterMenuById($titleMasterMenuId);
    public function deleteMasterMenu($titleMasterMenuId);
    public function createMasterMenu(array $titleMasterMenuDetails);
    public function updateMasterMenu($titleMasterMenuId, array $newDetails);
    public function getMasterMenuWithEloquent($condition, $relation);
}
