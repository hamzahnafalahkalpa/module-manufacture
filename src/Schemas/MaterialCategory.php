<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Schemas\MaterialCategory as ContractsMaterialCategory;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData;
use Illuminate\Database\Eloquent\Builder;

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

    public function materialCategory(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->MaterialCategoryModel()->conditionals($this->mergeCondition($conditionals))
                    ->withParameters()->orderBy('created_at','desc');
    }
}

