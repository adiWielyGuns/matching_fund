<?php

namespace App\Interfaces;

interface CmsManagementRepositoryInterface
{
    public function getAllCmsManagements();
    public function getIdCmsManagement();
    public function getCmsManagementById($cmsManagementId);
    public function deleteCmsManagement($cmsManagementId);
    public function createCmsManagement(array $cmsManagementDetails);
    public function updateCmsManagement($cmsManagementId, array $newDetails);
    public function getCmsManagementWithEloquent($relation);
}
