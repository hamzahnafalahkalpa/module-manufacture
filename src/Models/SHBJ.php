<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleManufacture\Resources\SHBJ\{
    ViewSHBJ, ShowSHBJ
};

//SATUAN HARGA BARANG DAN JASA
class SHBJ extends BaseModel{
    use SoftDeletes;

    protected $list = [
        'id', 'reference_type', 'reference_id', 'flag', 'price'
    ];

    public function getViewResource(){
        return ViewSHBJ::class;
    }

    public function getShowResource(){
        return ShowSHBJ::class;
    }

    public function reference(){return $this->morphTo();}
}