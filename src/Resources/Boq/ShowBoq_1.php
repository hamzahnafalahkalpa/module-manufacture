<?php

namespace Hanafalah\ModuleManufacture\Resources\Boq;

class ShowBoq extends ViewBoq
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
