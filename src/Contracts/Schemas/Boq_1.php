<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleManufacture\Contracts\Data\BoqData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Boq extends DataManagement
{
    public function getBoq(): mixed;
    public function prepareShowBoq(?Model $model = null, ?array $attributes = null): Model;
    public function showBoq(?Model $model = null): array;
    public function prepareStoreBoq(BoqData $employee_dto): Model;
    public function storeBoq(? BoqData $employee_dto = null): array;
    public function prepareViewBoqPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewBoqPaginate(? PaginateData $paginate_dto = null): array;
    public function prepareViewBoqList(): Collection;
    public function viewBoqList(): array;
    public function prepareDeleteBoq(? array $attributes = null): bool;
    public function deleteBoq(): bool;
    public function Boq(mixed $conditionals = null): Builder;
}
