<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'orders_id',
        'payment_method_id',
        'total_price',
        'total_payment',
        'total_change',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function PaymentDetail()
    {
        return $this->hasMany(PaymentDetail::class);
    }
    public function Order()
    {
        return $this->belongsTo('App\Models\Order', 'orders_id', 'id');
    }
}
