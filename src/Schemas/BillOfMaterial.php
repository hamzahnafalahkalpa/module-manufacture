<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\BillOfMaterial as ContractsBillOfMaterial;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\BillOfMaterialData;

class BillOfMaterial extends PackageManagement implements ContractsBillOfMaterial
{
    protected string $__entity = 'BillOfMaterial';
    public $bill_of_material_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'bill_of_material',
            'tags'     => ['bill_of_material', 'bill_of_material-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStoreBillOfMaterial(BillOfMaterialData $bill_of_material_dto): Model{
        $add = [
            'qty' => $bill_of_material_dto->qty,
            'coefficient' => $bill_of_material_dto->coefficient
        ];
        if (isset($bill_of_material_dto->id)){
            $guard = ['id' => $bill_of_material_dto->id];
        }else{
            $guard = [
                'bill_type'   => $bill_of_material_dto->bill_type,
                'bill_id'     => $bill_of_material_dto->bill_id,
                'material_type' => $bill_of_material_dto->material_type,
                'material_id' => $bill_of_material_dto->material_id
            ];
        }
        $bill_of_material = $this->usingEntity()->updateOrCreate($guard,$add);
        $this->fillingProps($bill_of_material,$bill_of_material_dto->props);
        $bill_of_material->save();
        return $this->bill_of_material_model = $bill_of_material;
    }
}

