<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'pais'];

    public function juegos()
    {
        return $this->hasMany(Juego::class);
    }
}
