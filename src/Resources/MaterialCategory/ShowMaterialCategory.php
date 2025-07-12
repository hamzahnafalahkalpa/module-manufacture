<?php

namespace Hanafalah\ModuleManufacture\Resources\MaterialCategory;

use Hanafalah\LaravelSupport\Resources\Unicode\ShowUnicode;

class ShowMaterialCategory extends ViewMaterialCategory
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $show = $this->resolveNow(new ShowUnicode($this));
        $arr  = $this->mergeArray(parent::toArray($request),$show, $arr);
        return $arr;
    }
}
