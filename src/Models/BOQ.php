<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleManufacture\Resources\BOQ\{ViewBOQ, ShowBOQ};


// BOQ ini ada hubungannya dengan bill of material data, dan juga RAB,
// BOQ merupkana hasil rinci hitungan BOM terhadap sebuah volume yang ada didalam RAB atau RAP
class BOQ extends BaseModel {
    use HasUlids, SoftDeletes, HasProps;

    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    protected $list       = [
        'id', 'shbj_id', 'name', 'volume', 'unit_id', 'unit_name', 'price', 'props'
    ];

    public function getViewResource(){
        return ViewBOQ::class;
    }

    public function getShowResource(){
        return ShowBOQ::class;
    }

    public function shbj(){return $this->belongsToModel('SHBJ');}
    public function unit(){return $this->belongsToModel('ItemStuff', 'unit_id');} 
}
