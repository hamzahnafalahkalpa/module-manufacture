<?php

namespace Hanafalah\ModuleManufacture\Resources\MaterialCategory;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewMaterialCategory extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'             => $this->id,
            'parent_id'      => $this->parent_id,
            'name'           => $this->name, 
            'note'           => $this->note,
            'childs'         => $this->relationValidation('childs', function () {
                return $this->childs->transform(function ($child) {
                    return new static($child);
                });
            })
        ];
        return $arr;
    }
}
