<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = "payment_details";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'payment_id',
        'total_price',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
