<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Schemas\Unicode;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleManufacture\Schemas\MaterialCategory
 * @method bool deleteMaterialCategory()
 * @method bool prepareDeleteMaterialCategory(? array $attributes = null)
 * @method mixed getMaterialCategory()
 * @method ?Model prepareShowMaterialCategory(?Model $model = null, ?array $attributes = null)
 * @method array showMaterialCategory(?Model $model = null)
 * @method Collection prepareViewMaterialCategoryList()
 * @method array viewMaterialCategoryList()
 * @method LengthAwarePaginator prepareViewMaterialCategoryPaginate(PaginateData $paginate_dto)
 * @method array viewMaterialCategoryPaginate(?PaginateData $paginate_dto = null)
 */

 interface MaterialCategory extends Unicode
 {
     public function prepareStoreMaterialCategory(MaterialCategoryData $material_category_dto): Model;
     public function materialCategory(mixed $conditionals = null): Builder;
 }