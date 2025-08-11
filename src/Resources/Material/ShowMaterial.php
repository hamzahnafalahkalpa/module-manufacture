<?php

namespace Hanafalah\ModuleManufacture\Resources\Material;

class ShowMaterial extends ViewMaterial
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
<<<<<<< HEAD
            'item' => $this->relationValidation('item',function(){
                return $this->item->toViewApi()->resolve();
            })
=======
            'bill_of_materials' => $this->relationValidation('billOfMaterials',function(){
                return $this->billOfMaterials->transform(function($billOfMaterial){
                   return $billOfMaterial->toViewApi(); 
                });
            })  
>>>>>>> 6bb9ba27f10bc3c2cf16c263baa8023b121eec43
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
