<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogRepository implements BlogRepositoryInterface
{
    public function getAllBlogs()
    {
        return Blog::all();
    }

    public function getAllBlogsActive($select = '*')
    {
        return Blog::select(DB::raw($select))->where('status', true)->get();
    }


    public function getBlogById($blogId)
    {
        return Blog::findOrFail($blogId);
    }

    public function deleteBlog($blogId)
    {
        Blog::destroy($blogId);
    }

    public function createBlog(array $blogDetails)
    {
        return Blog::create($blogDetails);
    }

    public function updateBlog($blogId, array $newDetails)
    {
        return Blog::whereId($blogId)->update($newDetails);
    }

    public function getIdBlog()
    {
        return Blog::max('id') + 1;
    }

    public function getBlogWithEloquent($relation)
    {
        return Blog::with($relation)->get();
    }
}
