<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'status'
    ];

    protected $casts = [
        'content' => 'array',
        'address' => 'array',
        'status' => OrderStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //uno a muchos 
    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
