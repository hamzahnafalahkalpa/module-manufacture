<?php

namespace Hanafalah\ModuleManufacture\Resources\Bom;

class ShowBom extends ViewBom
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [

        ];
        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}
