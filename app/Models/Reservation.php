<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = "reservations";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode',
        'tanggal',
        'jam',
        'pax',
        'nominal_transfer',
        'nama',
        'telpon',
        'bank',
        'no_rekening',
        'bukti_transfer',
        'order_id',
        'table_id',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'reservation_id', 'id');
    }
}
