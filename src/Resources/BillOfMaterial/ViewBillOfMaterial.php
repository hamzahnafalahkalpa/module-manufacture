<?php

namespace Hanafalah\ModuleManufacture\Resources\BillOfMaterial;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewBillOfMaterial extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'            => $this->id, 
            'bill_type'     => $this->bill_type, 
            'bill_id'       => $this->bill_id, 
            'material_type' => $this->material_type, 
            'material_id'   => $this->material_id, 
            'material'      => $this->prop_material,
            'coefficient'   => $this->coefficient, 
            'qty'           => $this->qty
        ];
        return $arr;
    }
}
