<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\ModuleManufacture\Contracts\Data\ProductData as DataProductData;

class ProductData extends MaterialData implements DataProductData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'Product';
    }
}
