<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = "faqs";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'content',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];
}
