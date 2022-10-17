<?php

namespace App\Interfaces;

interface PrivilegeRepositoryInterface
{
    public function getAllPrivileges();
    public function getIdPrivilege();
    public function getPrivilegeById($titlePrivilegeId);
    public function deletePrivilege($titlePrivilegeId);
    public function createPrivilege(array $titlePrivilegeDetails);
    public function updatePrivilege($titlePrivilegeId, array $newDetails);
    public function getPrivilegeWithEloquent($condition, $relation);
}
