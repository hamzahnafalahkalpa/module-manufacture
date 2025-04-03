<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\MaterialCategory as ContractsMaterialCategory;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MaterialCategory extends PackageManagement implements ContractsMaterialCategory
{
    protected string $__entity = 'MaterialCategory';
    public static $material_category_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'material_category',
            'tags'     => ['material_category', 'material_category-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return ['childs'];
    }

    protected function showUsingRelation(): array{
        return ['childs'];
    }

    public function getMaterialCategory(): mixed{
        return static::$material_category_model;
    }

    public function prepareShowMaterialCategory(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getMaterialCategory();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->materialCategory()->with($this->showUsingRelation())->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$material_category_model = $model;
    }    

    public function showMaterialCategory(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowMaterialCategory($model);
        });
    }

    public function prepareStoreMaterialCategory(MaterialCategoryData $material_category_dto): Model{
        $material_category = $this->materialCategory()->updateOrCreate([
            'id' => $material_category_dto->id ?? null,
        ],[
            'parent_id'      => $material_category_dto->parent_id ?? null,
            'name'           => $material_category_dto->name,
            'note'           => $material_category_dto->note ?? null
        ]);
        return static::$material_category_model = $material_category;
    }

    public function storeMaterialCategory(? MaterialCategoryData $material_category_dto = null): array{
        return $this->transaction(function () use ($material_category_dto) {
            return $this->showMaterialCategory($this->prepareStoreMaterialCategory($material_category_dto ?? $this->requestDTO(MaterialCategoryData::class)));
        });
    }

    public function prepareViewMaterialCategoryPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->materialCategory()->whereNull('parent_id')->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewMaterialCategoryPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewMaterialCategoryPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewMaterialCategoryList(): Collection{
        return $this->materialCategory()->whereNull('parent_id')->with($this->viewUsingRelation())->get();
    }

    public function viewMaterialCategoryList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewMaterialCategoryList();
        });
    }

    public function prepareDeleteMaterialCategory(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $material_category = $this->materialCategory()->findOrFail($attributes['id']);
        return $material_category->delete();
    }

    public function deleteMaterialCategory(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteMaterialCategory();
        });
    }

    public function materialCategory(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->MaterialCategoryModel()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('created_at','desc');
    }
}

