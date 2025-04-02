<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\SHBJ as ContractsSHBJ;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\SHBJData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SHBJ extends PackageManagement implements ContractsSHBJ
{
    protected string $__entity = 'SHBJ';
    public static $shbj_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'shbj',
            'tags'     => ['shbj', 'shbj-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getSHBJ(): mixed{
        return static::$shbj_model;
    }

    public function prepareShowSHBJ(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getSHBJ();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->shbj()->with($this->showUsingRelation())->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$shbj_model = $model;
    }    

    public function showSHBJ(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowSHBJ($model);
        });
    }

    public function prepareStoreSHBJ(SHBJData $shbj_dto): Model{
        $shbj = $this->shbj()->updateOrCreate([
            'id' => $shbj_dto->id ?? null,
        ],[
            'name'           => $shbj_dto->name,
            'flag'           => $shbj_dto->flag,
            'reference_type' => $shbj_dto->reference_type,
            'reference_id'   => $shbj_dto->reference_id,
            'price'          => $shbj_dto->price ?? 0
        ]);
        return static::$shbj_model = $shbj;
    }

    public function storeSHBJ(? SHBJData $shbj_dto = null): array{
        return $this->transaction(function () use ($shbj_dto) {
            return $this->showSHBJ($this->prepareStoreSHBJ($shbj_dto ?? $this->requestDTO(SHBJData::class)));
        });
    }

    public function prepareViewSHBJPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->shbj()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewSHBJPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewSHBJPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewSHBJList(): Collection{
        return $this->shbj()->with($this->viewUsingRelation())->get();
    }

    public function viewSHBJList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewSHBJList();
        });
    }

    public function prepareDeleteSHBJ(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $shbj = $this->shbj()->findOrFail($attributes['id']);
        return $shbj->delete();
    }

    public function deleteSHBJ(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteSHBJ();
        });
    }

    public function shbj(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->SHBJModel()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('created_at','desc');
    }
}

