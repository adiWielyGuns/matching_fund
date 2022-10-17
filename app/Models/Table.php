<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = "tables";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description',
        'kapasitas',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function table()
    {
        return $this->hasMany(Table::class);
    }
}
