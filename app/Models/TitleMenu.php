<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleMenu extends Model
{
    use HasFactory;

    protected $table = "title_menus";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'sequence',
        'name',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function group_menu()
    {
        return $this->hasMany(GroupMenu::class);
    }
}
