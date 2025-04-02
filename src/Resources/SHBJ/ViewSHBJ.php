<?php

namespace Hanafalah\ModuleManufacture\Resources\SHBJ;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewSHBJ extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'             => $this->id,
            'reference_type' => $this->reference_type,
            'reference_id'   => $this->reference_id,
            'name'           => $this->name, 
            'flag'           => $this->flag, 
            'price'          => $this->price
        ];
        return $arr;
    }
}
