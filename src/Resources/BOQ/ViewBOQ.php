<?php

namespace Hanafalah\ModuleManufacture\Resources\BOQ;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewBOQ extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'        => $this->id, 
            'shbj'      => $this->prop_s_h_b_j,
            'name'      => $this->name, 
            'volume'    => $this->volume,
            'unit'      => $this->prop_unit,
            'unit_name' => $this->unit_name,
            'price'     => $this->price
        ];
        return $arr;
    }
}
