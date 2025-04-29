<?php

namespace Hanafalah\ModuleManufacture\Resources\Material;

class ShowMaterial extends ViewMaterial
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
