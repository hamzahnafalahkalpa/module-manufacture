<?php

namespace Hanafalah\ModuleManufacture\Resources\Product;

use Hanafalah\LaravelSupport\Resources\ApiResource;
use Illuminate\Http\Request;

class ViewProduct extends ApiResource{
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name, 
            'item' => $this->relationValidation('item',function(){
                return $this->item->toViewApi()->resolve();
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}