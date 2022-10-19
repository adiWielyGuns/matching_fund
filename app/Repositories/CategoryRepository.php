<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategorys()
    {
        return Category::all();
    }

    public function getCategoryById($orderId)
    {
        return Category::findOrFail($orderId);
    }

    public function getAllCategoryActive($select = '*')
    {
        return Category::select(DB::raw($select))->where('status', true)->get();
    }

    public function deleteCategory($orderId)
    {
        Category::destroy($orderId);
    }

    public function createCategory(array $orderDetails)
    {
        return Category::create($orderDetails);
    }

    public function updateCategory($orderId, array $newDetails)
    {
        return Category::whereId($orderId)->update($newDetails);
    }

    public function getIdCategory()
    {
        return Category::max('id') + 1;
    }

    public function getCategoryWithEloquent($relation)
    {
        return Category::with($relation)->get();
    }
}
