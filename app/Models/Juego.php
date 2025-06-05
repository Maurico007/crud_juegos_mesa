<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad_recomendada',
        'imagen',
        'fabricante_id'
    ];

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }
}
