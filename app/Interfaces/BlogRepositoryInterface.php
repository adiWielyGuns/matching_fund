<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
    public function getAllBlogs();
    public function getIdBlog();
    public function getBlogById($blogId);
    public function getAllBlogsActive($select);
    public function deleteBlog($blogId);
    public function createBlog(array $blogDetails);
    public function updateBlog($blogId, array $newDetails);
    public function getBlogWithEloquent($relation);
}
