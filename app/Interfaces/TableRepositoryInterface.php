<?php

namespace App\Interfaces;

interface TableRepositoryInterface
{
    public function getAllTables();
    public function getAllTablesActive($select);
    public function getIdTable();
    public function getTableById($titleMenuId);
    public function deleteTable($titleMenuId);
    public function createTable(array $titleMenuDetails);
    public function updateTable($titleMenuId, array $newDetails);
    public function getTableWithEloquent($relation);
}
