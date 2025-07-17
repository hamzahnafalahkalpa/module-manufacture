<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleItem\Concerns\HasItem;
use Hanafalah\ModuleManufacture\Resources\Product\{ViewProduct, ShowProduct};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel{
    use HasUlids, HasProps, SoftDeletes, HasItem;

    public $incrementing  = false;
    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    protected $list       = [
        'id', 'name', 'props'
    ];

    public function getViewResource(){
        return ViewProduct::class;
    }

    public function getShowResource(){
        return ShowProduct::class;
    }

    public function boms(){return $this->hasManyModel('Bom','item_id','item_id');}
    public function materials(){
        return $this->belongsToManyModel('Material','Bom','item_id','material_id','item_id','id');
    }
}