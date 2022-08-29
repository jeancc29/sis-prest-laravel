<?php
namespace App\Traits;

use Illuminate\Database\Query\Builder;

trait SetearUserYCompaniaIdYFiltrarPorCompania{
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function($model){
            $model->user_id = auth()->id;
            $model->compania_id = auth()->compania_id;
        });

        self::addGlobalScope(function (Builder $builder){
            $builder->where("compania_id", auth()->compania_id);
        });

    }
}
