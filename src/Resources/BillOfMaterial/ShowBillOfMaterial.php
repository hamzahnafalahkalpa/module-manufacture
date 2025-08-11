<?php

namespace Hanafalah\ModuleManufacture\Resources\BillOfMaterial;

class ShowBillOfMaterial extends ViewBillOfMaterial
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'material' => $this->relationValidation('material',function(){
                return $this->material->toViewApi()->resolve();
            },$this->prop_material)
        ];
        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}
