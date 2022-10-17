<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "schedules";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'master_menu_id',
        'date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function master_menu()
    {
        return $this->belongsTo(MasterMenu::class);
    }
}
