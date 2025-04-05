<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Material as ContractsMaterial;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Material extends PackageManagement implements ContractsMaterial
{
    protected string $__entity = 'Material';
    public static $material_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'material',
            'tags'     => ['material', 'material-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getMaterial(): mixed{
        return static::$material_model;
    }

    public function prepareShowMaterial(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();
        $model ??= $this->getMaterial();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->material()->with($this->showUsingRelation())->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$material_model = $model;
    }    

    public function showMaterial(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowMaterial($model);
        });
    }

    public function prepareStoreMaterial(MaterialData $material_dto): Model{
        $material = $this->material()->updateOrCreate([
            'id' => $material_dto->id ?? null
        ],[
            'name'                 => $material_dto->name,
            'material_category_id' => $material_dto->material_category_id
        ]);
        $material->load('item');
        $item = $material->item;
        $material->item_id = $item->getKey(); 
        $material->sync($item,['id','name']);

        foreach ($material_dto->props as $key => $prop) $material->{$key} = $prop;
        $material->save();
        if (isset($material_dto->item)){
            $item_dto     = &$material_dto->item;
            $item_dto->id = $item->getKey();
            $this->schemaContract('Item')->prepareStoreItem($item_dto);
        }
        return static::$material_model = $material;
    }

    public function storeMaterial(? MaterialData $material_dto = null): array{
        return $this->transaction(function() use ($material_dto) {
            return $this->showMaterial($this->prepareStoreMaterial($material_dto ?? $this->requestDTO(MaterialData::class)));
        });
    }

    public function prepareViewMaterialPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->material()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewMaterialPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewMaterialPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewMaterialList(): Collection{
        return $this->material()->with($this->viewUsingRelation())->get();
    }

    public function viewMaterialList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewMaterialList();
        });
    }

    public function prepareDeleteMaterial(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $material = $this->material()->findOrFail($attributes['id']);
        return $material->delete();
    }

    public function deleteMaterial(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteMaterial();
        });
    }

    public function material(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->MaterialModel()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('name','asc');
    }
}

