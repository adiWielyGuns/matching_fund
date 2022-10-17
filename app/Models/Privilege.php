<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $table = "privileges";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'role_id',
        'menu_id',
        'view', 'create', 'update', 'delete',
        'print',
        'validation',
        'created_at',
        'updated_at'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
