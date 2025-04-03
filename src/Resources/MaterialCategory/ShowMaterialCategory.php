<?php

namespace Hanafalah\ModuleManufacture\Resources\MaterialCategory;

class ShowMaterialCategory extends ViewMaterialCategory
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
