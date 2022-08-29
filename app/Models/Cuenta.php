<?php

namespace App\Models;

use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["descripcion", "banco_id", "compania_id"];

}
