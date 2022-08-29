<?php

namespace Database\Seeders;

use App\Models\Entidad;
use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entidad = Entidad::whereDescripcion("Dashboard")->first();
        Permiso::updateOrCreate(["descripcion" => 'Dashboard', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Clientes")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Prestamos")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);
        // Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Pagos")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Cambiar fecha', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Cambiar caja', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Modificar mora', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Descuento', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Cajas")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Abrir', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Ver cierres', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Realizar cierres', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Realizar ajustes', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Hacer transferencias', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Bancos")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Cuentas")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Rutas")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Configuraciones")->first();
        Permiso::updateOrCreate(["descripcion" => 'Empresa', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Prestamo', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Recibo', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Otros', "idEntidad" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Garantías")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "idEntidad" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Cambiar estado', "idEntidad" => $entidad->id],);
    }
}
