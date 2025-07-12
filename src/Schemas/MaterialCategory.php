<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Schemas\Unicode;
use Hanafalah\ModuleManufacture\Contracts\Schemas\MaterialCategory as ContractsMaterialCategory;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData;
use Illuminate\Database\Eloquent\Builder;

class MaterialCategory extends Unicode implements ContractsMaterialCategory
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
        $material_category = $this->prepareStoreUnicode($material_category_dto);
        return static::$material_category_model = $material_category;
    }

    public function materialCategory(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}

