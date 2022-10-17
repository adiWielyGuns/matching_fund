<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsManagement extends Model
{
    use HasFactory;

    protected $table = "cms_managements";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'value',
        'type',
        'example',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];
}
