<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\MorphOneFoto;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory, BelongsToCompania, SetearYFiltrarPorCompaniaId, MorphOneFoto;

    protected $fillable = [
        'id',
        'nombre',
//        'foto',
        'direccion',
        'ciudad',
        'telefono1',
        'telefono2',
        'gerenteSucursal',
        'gerenteCobro',
        'status',
        'compania_id',
    ];

    public static function removeUsers($idSucursal){
        \DB::select("
            UPDATE users
            SET
                users.idSucursal = null
            WHERE users.idSucursal = $idSucursal
        ");
    }
}
