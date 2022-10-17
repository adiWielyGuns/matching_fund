<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getIdRole();
    public function getRoleById($titleRoleId);
    public function deleteRole($titleRoleId);
    public function createRole(array $titleRoleDetails);
    public function updateRole($titleRoleId, array $newDetails);
    public function getRoleWithEloquent($condition, $relation);
}
