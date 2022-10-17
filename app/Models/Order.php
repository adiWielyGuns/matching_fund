<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode',
        'name',
        'telpon',
        'pax',
        'table_id',
        'payment_method_id',
        'reservation_id',
        'no_ref',
        'nama_ref',
        'jenis',
        'total_price',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment_method()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'id', 'reservation_id');
    }
}
