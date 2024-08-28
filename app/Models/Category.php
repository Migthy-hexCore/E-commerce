<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'name',
        'family_id'
    ];

    //relacion uno a muchos
    public function family(){
        return $this->belongsTo(Family::class);
    }

    //relacion uno a muchos
    public function products(){
        return $this->hasMany(Subcategory::class);
    }
}
