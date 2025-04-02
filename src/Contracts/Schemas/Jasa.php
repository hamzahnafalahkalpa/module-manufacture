<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleManufacture\Contracts\Data\JasaData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Jasa extends DataManagement
{
    public function getJasa(): mixed;
    public function prepareShowJasa(?Model $model = null, ?array $attributes = null): Model;
    public function showJasa(?Model $model = null): array;
    public function prepareStoreJasa(JasaData $employee_dto): Model;
    public function storeJasa(? JasaData $employee_dto = null): array;
    public function prepareViewJasaPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewJasaPaginate(? PaginateData $paginate_dto = null): array;
    public function prepareViewJasaList(): Collection;
    public function viewJasaList(): array;
    public function prepareDeleteJasa(? array $attributes = null): bool;
    public function deleteJasa(): bool;
    public function jasa(mixed $conditionals = null): Builder;
}
