<?php

namespace App\Repositories;

use App\Interfaces\TableRepositoryInterface;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    public function getAllTables()
    {
        return Table::all();
    }

    public function getAllTablesActive($select = '*')
    {
        return Table::select(DB::raw($select))->where('status', true)->get();
    }

    public function getTableById($orderId)
    {
        return Table::findOrFail($orderId);
    }

    public function deleteTable($orderId)
    {
        Table::destroy($orderId);
    }

    public function createTable(array $orderDetails)
    {
        return Table::create($orderDetails);
    }

    public function updateTable($orderId, array $newDetails)
    {
        return Table::whereId($orderId)->update($newDetails);
    }

    public function getIdTable()
    {
        return Table::max('id') + 1;
    }

    public function getTableWithEloquent($relation)
    {
        return Table::with($relation)->get();
    }
}
