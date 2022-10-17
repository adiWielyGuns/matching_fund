<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = "payment_methods";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description',
        'jenis',
        'no_ref',
        'nama_ref',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
