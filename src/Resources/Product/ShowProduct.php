<?php

namespace Hanafalah\ModuleManufacture\Resources\Product;

use Illuminate\Http\Request;

class ShowProduct extends ViewProduct{
    public function toArray(Request $request): array
    {
        $arr = [
            'item' => $this->relationValidation('item',function(){
                return $this->item->toViewApi()->resolve();
            }),
            'materials' => $this->relationValidation('materials',function(){
                return $this->materials->transform(function($material){
                    return $material->toViewApi()->resolve();
                });
            })
        ];

        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}