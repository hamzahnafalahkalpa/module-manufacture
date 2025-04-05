<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Bom as ContractsBom;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\BomData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getBom(): mixed{
        return static::$bom_model;
    }

    public function prepareShowBom(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getBom();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->bom()->with($this->showUsingRelation())->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$bom_model = $model;
    }    

    public function showBom(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowBom($model);
        });
    }

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
        foreach ($bom_dto->props as $key => $prop) $bom->{$key} = $prop;
        $bom->save();
        return static::$bom_model = $bom;
    }

    public function storeBom(? BomData $bom_dto = null): array{
        return $this->transaction(function() use ($bom_dto) {
            return $this->showBom($this->prepareStoreBom($bom_dto ?? $this->requestDTO(BomData::class)));
        });
    }

    public function prepareViewBomPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->bom()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewBomPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewBomPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewBomList(): Collection{
        return $this->bom()->with($this->viewUsingRelation())->get();
    }

    public function viewBomList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewBomList();
        });
    }

    public function prepareDeleteBom(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $bom = $this->bom()->findOrFail($attributes['id']);
        return $bom->delete();
    }

    public function deleteBom(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteBom();
        });
    }

    public function bom(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->BomModel()->conditionals($this->mergeCondition($conditionals))->withParameters();
    }
}

