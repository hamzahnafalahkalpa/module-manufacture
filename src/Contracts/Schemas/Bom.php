<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleManufacture\Contracts\Data\BomData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleManufacture\Schemas\Bom
 * @method bool deleteBom()
 * @method bool prepareDeleteBom(? array $attributes = null)
 * @method mixed getBom()
 * @method ?Model prepareShowBom(?Model $model = null, ?array $attributes = null)
 * @method array showBom(?Model $model = null)
 * @method Collection prepareViewBomList()
 * @method array viewBomList()
 * @method LengthAwarePaginator prepareViewBomPaginate(PaginateData $paginate_dto)
 * @method array viewBomPaginate(?PaginateData $paginate_dto = null)
 */

 interface Bom extends DataManagement
 {
     public function prepareStoreBom(BomData $bom_dto): Model;
     public function storeBom(?BomData $bom_dto = null): array;
     public function Bom(mixed $conditionals = null): Builder;
 }