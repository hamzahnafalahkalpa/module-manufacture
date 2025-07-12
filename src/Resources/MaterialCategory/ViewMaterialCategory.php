<?php

namespace Hanafalah\ModuleManufacture\Resources\MaterialCategory;

use Hanafalah\LaravelSupport\Resources\ApiResource;
use Hanafalah\LaravelSupport\Resources\Unicode\ViewUnicode;

class ViewMaterialCategory extends ViewUnicode
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'note'           => $this->note,
        ];
        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}
