<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'sequence',
        'name',
        'group_menu_id',
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

    public function group_menu()
    {
        return $this->belongsTo(GroupMenu::class);
    }

    public function privilege()
    {
        return $this->hasMany(privilege::class);
    }
}
