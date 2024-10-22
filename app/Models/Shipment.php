<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'order_id',
        'driver_id',
        'status',
        'refunded_at',
        'delivered_at'
    ];

    //casting
    protected $casts = [
        'status' => ShipmentStatus::class,
        'refunded_at' => 'datetime',
        'delivered_at' => 'datetime'
    ];

    //relacion una a muchos inversa
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //relacion una a muchos inversa
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
