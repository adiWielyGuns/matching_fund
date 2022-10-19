<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMenu extends Model
{
    use HasFactory;

    protected $table = "master_menus";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'category_id',
        'created_by',
        'updated_by',
        'status',
        'created_at',
        'updated_at',
        'price',
        'price_after_discount',
        'slug',
        'is_favorite',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
