<?php

namespace Hanafalah\ModuleManufacture\Resources\Material;

class ShowMaterial extends ViewMaterial
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'bill_of_materials' => $this->relationValidation('billOfMaterials',function(){
                return $this->billOfMaterials->transform(function($billOfMaterial){
                   return $billOfMaterial->toViewApi(); 
                });
            })  
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
