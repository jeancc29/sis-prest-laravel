<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory, BelongsToCompania, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["descripcion", "balanceInicial", "balance", "compania_id"];

}
