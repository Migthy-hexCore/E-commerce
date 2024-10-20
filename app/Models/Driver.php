<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    //asignación masiva
    protected $fillable = [
        'user_id',
        'type',
        'plate_number'
    ];

    //relación uno a uno
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
