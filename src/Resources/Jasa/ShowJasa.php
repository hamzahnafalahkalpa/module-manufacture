<?php

namespace Hanafalah\ModuleManufacture\Resources\Jasa;

class ShowJasa extends ViewJasa
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $arr  = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
