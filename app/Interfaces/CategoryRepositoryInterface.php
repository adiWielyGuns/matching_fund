<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategorys();
    public function getIdCategory();
    public function getCategoryById($titleMenuId);
    public function getAllCategoryActive($select = '*');
    public function deleteCategory($titleMenuId);
    public function createCategory(array $titleMenuDetails);
    public function updateCategory($titleMenuId, array $newDetails);
    public function getCategoryWithEloquent($relation);
}
