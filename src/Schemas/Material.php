<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Material as ContractsMaterial;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialData;
use Illuminate\Database\Eloquent\Builder;

class Material extends PackageManagement implements ContractsMaterial
{
    protected string $__entity = 'Material';
    public $material_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'material',
            'tags'     => ['material', 'material-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStore(MaterialData $material_dto): Model{
        return $this->prepareStoreMaterial($material_dto);
    }

    public function prepareStoreMaterial(MaterialData $material_dto): Model{
        $material = $this->material()->updateOrCreate([
            'id' => $material_dto->id ?? null
        ],[
            'name'                 => $material_dto->name,
            'material_category_id' => $material_dto->material_category_id ?? null
        ]);
        $this->fillingProps($material,$material_dto->props);
        $material->save();
        if (isset($material_dto->item)){
            $item_dto                 = $material_dto->item;
            $item_dto->id             = $material->item->getKey();
            $item_dto->name           = $material_dto->name;
            $item_dto->reference_id   = $material->getKey();
            $item_dto->reference_type = $material->getMorphClass();
            $this->schemaContract('item')->prepareStoreItem($item_dto);
        }
        return $this->material_model = $material;
    }

    public function storeMaterial(? MaterialData $material_dto = null): array{
        return $this->transaction(function() use ($material_dto) {
            return $this->showMaterial($this->prepareStoreMaterial($material_dto ?? $this->requestDTO(MaterialData::class)));
        });
    }

    public function material(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->MaterialModel()->conditionals($this->mergeCondition($conditionals))->withParameters();
    }
}

