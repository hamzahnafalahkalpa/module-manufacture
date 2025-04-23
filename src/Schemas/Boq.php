<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Boq as ContractsBoq;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\BoqData;
use Illuminate\Database\Eloquent\Builder;

class Boq extends PackageManagement implements ContractsBoq
{
    protected string $__entity = 'Boq';
    public static $boq_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'boq',
            'tags'     => ['boq', 'boq-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStoreBoq(BoqData $boq_dto): Model{
        $boq = $this->boq()->updateOrCreate([
            'id' => $boq_dto->id ?? null
        ],[
            'shbj_id'   => $boq_dto->shbj_id ?? null,
            'name'      => $boq_dto->name,
            'volume'    => $boq_dto->volume ?? null,
            'unit_id'   => $boq_dto->unit_id ?? null,
            'unit_name' => $boq_dto->unit_name ?? null,
            'price'     => $boq_dto->price ?? null
        ]);
        $this->fillingProps($boq,$boq_dto->props);
        $boq->save();
        return static::$boq_model = $boq;
    }

    public function storeBoq(? BoqData $boq_dto = null): array{
        return $this->transaction(function() use ($boq_dto) {
            return $this->showBoq($this->prepareStoreBoq($boq_dto ?? $this->requestDTO(BoqData::class)));
        });
    }

    public function boq(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->BoqModel()->conditionals($this->mergeCondition($conditionals))->withParameters();
    }
}

