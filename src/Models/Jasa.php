<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleManufacture\Resources\Jasa\{
    ViewJasa, ShowJasa
};
use Hanafalah\ModuleService\Concerns\HasService;

//SATUAN HARGA BARANG DAN JASA
class Jasa extends BaseModel{
    use SoftDeletes, HasService;

    protected $list = [
        'id', 'name', 'note'
    ];

    public function getViewResource(){
        return ViewJasa::class;
    }

    public function getShowResource(){
        return ShowJasa::class;
    }

    public function shbj(){
        $service_table = $this->ServiceModel()->getTable();
        $shbjs_table   = $this->SHBJSModel()->getTable();
        return $this->hasManyThroughModel(
            'SHBJ', // Target akhir (SHBJ)
            'Service', // Perantara (Service)
            'reference_id', // Foreign key di Service yang mengarah ke Jasa
            'reference_id', // Foreign key di SHBJ yang mengarah ke Service
            'id', // Primary key di Jasa
            'id'  // Primary key di Service
        )->where($service_table.'.reference_type', $this->JasaModelMorph()) // Pastikan Service mengarah ke Jasa
        ->where($shbjs_table.'.reference_type', $this->ServiceModelMorph()); // Pastikan SHBJ mengarah ke Service
    }
}