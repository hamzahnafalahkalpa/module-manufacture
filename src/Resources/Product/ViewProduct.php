<?php

namespace Hanafalah\ModuleManufacture\Resources\Product;

use Hanafalah\ModuleManufacture\Resources\Material\ViewMaterial;
use Illuminate\Http\Request;

class ViewProduct extends ViewMaterial{
    public function toArray(Request $request): array
    {
        $arr = [
        ];
        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}