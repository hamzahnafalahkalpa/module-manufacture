<?php

namespace Hanafalah\ModuleManufacture\Resources\Product;

use Hanafalah\ModuleManufacture\Resources\Material\ShowMaterial;
use Illuminate\Http\Request;

class ShowProduct extends ViewProduct{
    public function toArray(Request $request): array
    {
        $arr = [
            'service' => $this->relationValidation('service', function () {
                return $this->service->toShowApi()->resolve();
            },$this->prop_service ?? null)
        ];
        $show = $this->resolveNow(new ShowMaterial($this));
        $arr = $this->mergeArray(parent::toArray($request),$show,$arr);
        return $arr;
    }
}