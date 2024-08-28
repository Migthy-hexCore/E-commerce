<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'sku',
        'image_path',
        'product_id',
    ];

    //relacion uno a muchos inversa
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //relacion muchos a muchos
    public function features()
    {
        return $this->belongsToMany(Features::class)
            ->withTimestamps();
    }
}
