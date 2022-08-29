<?php

namespace App\Models;

use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["descripcion", "estado", "compania_id"];
}
