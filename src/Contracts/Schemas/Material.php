<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialData;

/**
 * @see \Hanafalah\ModuleManufacture\Schemas\Material
 * @method bool deleteMaterial()
 * @method bool prepareDeleteMaterial(? array $attributes = null)
 * @method mixed getMaterial()
 * @method ?Model prepareShowMaterial(?Model $model = null, ?array $attributes = null)
 * @method array showMaterial(?Model $model = null)
 * @method Collection prepareViewMaterialList()
 * @method array viewMaterialList()
 * @method LengthAwarePaginator prepareViewMaterialPaginate(PaginateData $paginate_dto)
 * @method array viewMaterialPaginate(?PaginateData $paginate_dto = null)
 */

interface Material extends DataManagement
{
    public function prepareStoreMaterial(MaterialData $funding_dto): Model;
    public function storeMaterial(?MaterialData $funding_dto = null): array;
    public function material(mixed $conditionals = null): Builder;
}
