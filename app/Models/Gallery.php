<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = "galleries";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'image',
        'slug',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
