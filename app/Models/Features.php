<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = [
        'name',
        'description',
        'option_id',
    ];

    //relacion uno a muchos inversa
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    //relacion uno a muchos
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
