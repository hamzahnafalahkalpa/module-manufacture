<?php

namespace Hanafalah\ModuleManufacture\Resources\Boq;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewBoq extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'        => $this->id, 
            'shbj'      => $this->prop_Shbj,
            'name'      => $this->name, 
            'volume'    => $this->volume,
            'unit'      => $this->prop_unit,
            'unit_name' => $this->unit_name,
            'price'     => $this->price
        ];
        return $arr;
    }
}
