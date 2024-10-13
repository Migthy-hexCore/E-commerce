<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'region',
        'reference',
        'receiver',
        'receiver_info',
        'default',
    ];

    //casteo de datos
    protected $casts = [
        'receiver_info' => 'array',
        'default' => 'boolean',
    ];

    //
}
