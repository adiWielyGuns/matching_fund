<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "order_details";
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_id',
        'id',
        'price',
        'qty',
        'sub_total',
        'master_menu_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function master_menu()
    {
        return $this->belongsTo(MasterMenu::class);
    }
}
