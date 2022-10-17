<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = "contacts";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];
}
