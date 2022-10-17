<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMenu extends Model
{
    use HasFactory;

    protected $table = "group_menus";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'sequence',
        'name',
        'title_menu_id',
        'icon',
        'type',
        'slug',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function title_menu()
    {
        return $this->belongsTo(TitleMenu::class);
    }

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
