<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleManufacture\Resources\MaterialCategory\{ShowMaterialCategory, ViewMaterialCategory};

class MaterialCategory extends BaseModel
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $list = [
        'id', 'parent_id', 'name', 'note'
    ];

    public function viewUsingRelation(): array{
        return ['childs'];
    }

    public function showUsingRelation(): array{
        return ['childs'];
    }

    public function getViewResource(){
        return ViewMaterialCategory::class;
    }

    public function getShowResource(){
        return ShowMaterialCategory::class;
    }

    public function childs(){return $this->hasManyModel('MaterialCategory','parent_id')->with('childs');}

    public function material(){return $this->hasOneModel('Material');}
    public function materials(){return $this->hasManyModel('Material');}
}
