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
        'name' => 'string',
        'material_category_name' => 'string'
    ];

    public function getPropsQuery(): array{
        return [
            'material_category_name' => 'props->prop_material_category->name'
        ];
    }

    protected static function booted(): void{
        parent::booted();
        static::creating(function($query){
            if (!isset($query->material_code)){
                $query->material_code = static::hasEncoding('MATERIAL_CODE'); 
            }
        });
    }

    public function viewUsingRelation(): array{
        return ['item'];
    }

    public function showUsingRelation(): array{
        return ['item'];
    }

    public function getViewResource(){
        return ViewMaterial::class;
    }

    public function getShowResource(){
        return ShowMaterial::class;
    }

    public function item(){return $this->morphOneModel('Item','reference');}
    public function bom(){return $this->hasOneModel('BOM');}
    public function boms(){return $this->hasManyModel('BOM');}
}