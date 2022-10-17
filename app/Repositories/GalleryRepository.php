<?php

namespace App\Repositories;

use App\Interfaces\GalleryRepositoryInterface;
use App\Models\Gallery;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function getAllGallerys()
    {
        return Gallery::all();
    }

    public function getGalleryById($galleryId)
    {
        return Gallery::findOrFail($galleryId);
    }

    public function deleteGallery($galleryId)
    {
        Gallery::destroy($galleryId);
    }

    public function createGallery(array $galleryDetails)
    {
        return Gallery::create($galleryDetails);
    }

    public function updateGallery($galleryId, array $newDetails)
    {
        return Gallery::whereId($galleryId)->update($newDetails);
    }

    public function getIdGallery()
    {
        return Gallery::max('id') + 1;
    }

    public function getGalleryWithEloquent($relation)
    {
        return Gallery::with($relation)->get();
    }
}
