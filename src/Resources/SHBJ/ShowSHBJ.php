<?php

namespace Hanafalah\ModuleManufacture\Resources\SHBJ;

class ShowSHBJ extends ViewSHBJ
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'reference' => $this->relationValidation('reference',function(){
                return $this->reference->toShowApi();
            })
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
