<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\LaravelSupport\Models\Unicode\Unicode;
use Hanafalah\ModuleManufacture\Resources\MaterialCategory\{ShowMaterialCategory, ViewMaterialCategory};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class MaterialCategory extends Unicode
{
    protected $table = 'unicodes';

    public function getViewResource(){
        return ViewMaterialCategory::class;
    }

    public function getShowResource(){
        return ShowMaterialCategory::class;
    }

    public function material(){return $this->hasOneModel('Material');}
    public function materials(){return $this->hasManyModel('Material');}
}
