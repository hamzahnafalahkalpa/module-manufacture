<?php

namespace Hanafalah\ModuleManufacture\Resources\Material;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewMaterial extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'                => $this->id, 
            'name'              => $this->name, 
            'material_category' => $this->prop_material_category
        ];
        return $arr;
    }
}
