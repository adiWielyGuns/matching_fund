<?php

namespace App\Interfaces;

interface TitleMenuRepositoryInterface
{
    public function getAllTitleMenus();
    public function getIdTitleMenu();
    public function getTitleMenuById($titleMenuId);
    public function deleteTitleMenu($titleMenuId);
    public function createTitleMenu(array $titleMenuDetails);
    public function updateTitleMenu($titleMenuId, array $newDetails);
    public function getTitleMenuWithEloquent($condition, $relation);
}
