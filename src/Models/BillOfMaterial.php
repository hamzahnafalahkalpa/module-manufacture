<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleManufacture\Resources\BillOfMaterial\{ViewBillOfMaterial, ShowBillOfMaterial};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillOfMaterial extends BaseModel{
    use HasUlids, SoftDeletes, HasProps;

    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    protected $list = [
        'id', 'bill_type', 'bill_id', 'material_type', 'material_id', 
        'coefficient', 'qty', 'props'
    ];

    public function getViewResource(){
        return ViewBillOfMaterial::class;
    }

    public function getShowResource(){
        return ShowBillOfMaterial::class;
    }

    public function item(){return $this->belongsToModel('Item');} 
    public function material(){return $this->belongsToModel('Material');}
}