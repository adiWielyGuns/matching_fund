<?php

namespace App\Interfaces;

interface GalleryRepositoryInterface
{
    public function getAllGallerys();
    public function getIdGallery();
    public function getGalleryById($blogId);
    public function deleteGallery($blogId);
    public function createGallery(array $blogDetails);
    public function updateGallery($blogId, array $newDetails);
    public function getGalleryWithEloquent($relation);
}
