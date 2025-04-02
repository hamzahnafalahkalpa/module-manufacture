<?php

namespace Hanafalah\ModuleManufacture\Resources\Jasa;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewJasa extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'   => $this->id,
            'name' => $this->name, 
            'note' => $this->note
        ];
        return $arr;
    }
}
