<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleManufacture\Contracts\Data\BOQData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BOQ extends DataManagement
{
    public function getBOQ(): mixed;
    public function prepareShowBOQ(?Model $model = null, ?array $attributes = null): Model;
    public function showBOQ(?Model $model = null): array;
    public function prepareStoreBOQ(BOQData $employee_dto): Model;
    public function storeBOQ(? BOQData $employee_dto = null): array;
    public function prepareViewBOQPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewBOQPaginate(? PaginateData $paginate_dto = null): array;
    public function prepareViewBOQList(): Collection;
    public function viewBOQList(): array;
    public function prepareDeleteBOQ(? array $attributes = null): bool;
    public function deleteBOQ(): bool;
    public function BOQ(mixed $conditionals = null): Builder;
}
