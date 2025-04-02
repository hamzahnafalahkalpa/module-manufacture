<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Jasa as ContractsJasa;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\JasaData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Jasa extends PackageManagement implements ContractsJasa
{
    protected string $__entity = 'Jasa';
    public static $jasa_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'jasa',
            'tags'     => ['jasa', 'jasa-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getJasa(): mixed{
        return static::$jasa_model;
    }

    public function prepareShowJasa(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getJasa();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->jasa()->with($this->showUsingRelation())->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$jasa_model = $model;
    }    

    public function showJasa(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowJasa($model);
        });
    }

    public function prepareStoreJasa(JasaData $jasa_dto): Model{
        $jasa = $this->jasa()->updateOrCreate([
            'name' => $jasa_dto->name,
        ],[
            'note' => $jasa_dto->note
        ]);
        return static::$jasa_model = $jasa;
    }

    public function storeJasa(? JasaData $jasa_dto = null): array{
        return $this->transaction(function () use ($jasa_dto) {
            return $this->showJasa($this->prepareStoreJasa($jasa_dto ?? $this->requestDTO(JasaData::class)));
        });
    }

    public function prepareViewJasaPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->jasa()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewJasaPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewJasaPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewJasaList(): Collection{
        return $this->jasa()->with($this->viewUsingRelation())->get();
    }

    public function viewJasaList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewJasaList();
        });
    }

    public function prepareDeleteJasa(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $jasa = $this->jasa()->findOrFail($attributes['id']);
        return $jasa->delete();
    }

    public function deleteJasa(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteJasa();
        });
    }

    public function jasa(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->JasaModel()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('created_at','desc');
    }
}

