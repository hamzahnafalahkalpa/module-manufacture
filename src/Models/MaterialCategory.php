<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleManufacture\Resources\MaterialCategory\{ShowMaterialCategory, ViewMaterialCategory};

class MaterialCategory extends BaseModel
{
    protected $list = [
        'id', 'parent_id', 'name', 'note'
    ];

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
