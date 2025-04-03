<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleItem\Concerns\HasItem;
use Hanafalah\ModuleManufacture\Resources\Material\{ViewMaterial, ShowMaterial};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends BaseModel{
    use HasUlids, HasProps, SoftDeletes, HasItem;

    public $list = [
        'id', 'material_code', 'name', 'material_category_id', 'props'
    ];
    public $show = [];

    protected $casts = [
        'name' => 'string'
    ];

    protected static function booted(): void{
        parent::booted();
        static::creating(function($query){
            if (!isset($query->material_code)){
                $query->material_code = static::hasEncoding('MATERIAL_CODE'); 
            }
        });
    }

    public function getViewResource(){
        return ViewMaterial::class;
    }

    public function getShowResource(){
        return ShowMaterial::class;
    }

    public function reference(){return $this->morphTo();}
    public function packaging(){return $this->belongsToModel('ItemStuff');}
}