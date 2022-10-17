<?php

namespace App\Repositories;

use App\Interfaces\CmsManagementRepositoryInterface;
use App\Models\CmsManagement;

class CmsManagementRepository implements CmsManagementRepositoryInterface
{
    public function getAllCmsManagements()
    {
        return CmsManagement::all();
    }

    public function getCmsManagementById($cmsManagementId)
    {
        return CmsManagement::findOrFail($cmsManagementId);
    }

    public function deleteCmsManagement($cmsManagementId)
    {
        CmsManagement::destroy($cmsManagementId);
    }

    public function createCmsManagement(array $cmsManagementDetails)
    {
        return CmsManagement::create($cmsManagementDetails);
    }

    public function updateCmsManagement($cmsManagementId, array $newDetails)
    {
        return CmsManagement::whereId($cmsManagementId)->update($newDetails);
    }

    public function getIdCmsManagement()
    {
        return CmsManagement::max('id') + 1;
    }

    public function getCmsManagementWithEloquent($relation)
    {
        return CmsManagement::with($relation)->get();
    }
}
