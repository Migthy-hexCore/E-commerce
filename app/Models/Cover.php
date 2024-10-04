<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cover extends Model
{
    use HasFactory;

    //asginacion masiva
    protected $fillable = [
        'image_path',
        'title',
        'start_at',
        'end_at',
        'is_active',
    ];

    //casteo de atributos
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    //accesores
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path),
        );
    }
}
