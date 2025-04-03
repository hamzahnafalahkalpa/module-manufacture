<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface MaterialCategory extends DataManagement
{
    public function getMaterialCategory(): mixed;
    public function prepareShowMaterialCategory(?Model $model = null, ?array $attributes = null): Model;
    public function showMaterialCategory(?Model $model = null): array;
    public function prepareStoreMaterialCategory(MaterialCategoryData $employee_dto): Model;
    public function storeMaterialCategory(? MaterialCategoryData $employee_dto = null): array;
    public function prepareViewMaterialCategoryPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewMaterialCategoryPaginate(? PaginateData $paginate_dto = null): array;
    public function prepareViewMaterialCategoryList(): Collection;
    public function viewMaterialCategoryList(): array;
    public function prepareDeleteMaterialCategory(? array $attributes = null): bool;
    public function deleteMaterialCategory(): bool;
    public function materialCategory(mixed $conditionals = null): Builder;
}
