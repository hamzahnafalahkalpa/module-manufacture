<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Bom as ContractsBom;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\BomData;
use Illuminate\Database\Eloquent\Builder;

class Bom extends PackageManagement implements ContractsBom
{
    protected string $__entity = 'Bom';
    public static $bom_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'bom',
            'tags'     => ['bom', 'bom-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStoreBom(BomData $bom_dto): Model{
        if (isset($bom_dto->id)){
            $guard = ['id' => $bom_dto->id];
        }else{
            $guard = [
                'item_id'     => $bom_dto->item_id,
                'material_id' => $bom_dto->material_id
            ];
        }
        $bom = $this->bom()->updateOrCreate($guard);
        $this->fillingProps($bom,$bom_dto->props);
        $bom->save();
        return static::$bom_model = $bom;
    }

    public function storeBom(? BomData $bom_dto = null): array{
        return $this->transaction(function() use ($bom_dto) {
            return $this->showBom($this->prepareStoreBom($bom_dto ?? $this->requestDTO(BomData::class)));
        });
    }

    public function bom(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->BomModel()->conditionals($this->mergeCondition($conditionals))->withParameters();
    }
}

