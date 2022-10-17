<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'image',
        'created_by',
        'updated_by',
        'status',
        'created_at',
        'updated_at'
    ];

    public function master_menu()
    {
        return $this->hasMany(MasterMenu::class);
    }
}
