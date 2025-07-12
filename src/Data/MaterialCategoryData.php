<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Data\UnicodeData;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData as DataMaterialCategoryData;

class MaterialCategoryData extends UnicodeData implements DataMaterialCategoryData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'MaterialCategory';
        parent::before($attributes);
    }
}
