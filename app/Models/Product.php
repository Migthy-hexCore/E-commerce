<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'stock',
        'subcategory_id',
    ];

    //accesores
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path),
        );
    }

    //relacion uno a muchos inversa
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    //relacion muchos a muchos
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    //relacion muchos a muchos
    public function options()
    {
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps();
    }
}
