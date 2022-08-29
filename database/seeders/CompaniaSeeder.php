<?php

namespace Database\Seeders;

use App\Models\Compania;
use App\Models\Direccion;
use Illuminate\Database\Seeder;

class CompaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->crearCompaniaPorDefecto();
    }

    public function crearCompaniaPorDefecto(){
        $tipo = \App\Tipo::where(["renglon" => "mora", "descripcion" => "Capital pendiente"])->first();
        $moneda = \App\Moneda::where(["codigo" => "DOP"])->first();
        $nacionalidad = \App\Nacionalidad::whereDescripcion("Dominicano")->first();
        $contacto = \App\Contacto::updateOrCreate(
            ["correo" => "no@no.com"],
            [
                "telefono" => "8294266800",
                "rnc" => "123456",
            ]
        );
//        $pais = \App\Country::whereNombre("Republica Dominicana")->first();
//        $estado = \App\State::where(["nombre" => "Santiago", "idPais" => $pais->id])->first();
//        $ciudad = \App\City::where(["nombre" => "Santiago", "idEstado" => $estado->id])->first();
        $direccion = Direccion::updateOrCreate(
            ["direccion" => "Direccion de prueba"],
            [
                "direccion2" => "hola",
                "codigoPostal" => '',
            ]
        );

        $empresa = Compania::updateOrCreate(
            ["nombre" => "Prueba"],
            [
                "status" => 1,
                "idTipoMora" => $tipo->id,
                "idMoneda" => $moneda->id,
                "idContacto" => $contacto->id,
                "idEmpresa" => 1,
//            "idNacionalidad" => $nacionalidad->id
            ]
        );
    }
}
