<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleManufacture\Contracts\Data\SHBJData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface SHBJ extends DataManagement
{
    public function getSHBJ(): mixed;
    public function prepareShowSHBJ(?Model $model = null, ?array $attributes = null): Model;
    public function showSHBJ(?Model $model = null): array;
    public function prepareStoreSHBJ(SHBJData $employee_dto): Model;
    public function storeSHBJ(? SHBJData $employee_dto = null): array;
    public function prepareViewSHBJPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewSHBJPaginate(? PaginateData $paginate_dto = null): array;
    public function prepareViewSHBJList(): Collection;
    public function viewSHBJList(): array;
    public function prepareDeleteSHBJ(? array $attributes = null): bool;
    public function deleteSHBJ(): bool;
    public function SHBJ(mixed $conditionals = null): Builder;
}
