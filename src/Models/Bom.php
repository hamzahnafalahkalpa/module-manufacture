<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleManufacture\Resources\Bom\{ViewBom, ShowBom};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bom extends BaseModel{
    use HasUlids, SoftDeletes, HasProps;

    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    protected $list = [
        'id', 'item_id', 'material_id', 'props'
    ];

    public function getViewResource(){
        return ViewBom::class;
    }

    public function getShowResource(){
        return ShowBom::class;
    }

    public function item(){return $this->belongsToModel('Item');} 
    public function material(){return $this->belongsToModel('Material');}
}