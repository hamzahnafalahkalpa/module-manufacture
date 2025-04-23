<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleManufacture\Contracts\Data\BoqData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleManufacture\Schemas\Boq
 * @method bool deleteBoq()
 * @method bool prepareDeleteBoq(? array $attributes = null)
 * @method mixed getBoq()
 * @method ?Model prepareShowBoq(?Model $model = null, ?array $attributes = null)
 * @method array showBoq(?Model $model = null)
 * @method Collection prepareViewBoqList()
 * @method array viewBoqList()
 * @method LengthAwarePaginator prepareViewBoqPaginate(PaginateData $paginate_dto)
 * @method array viewBoqPaginate(?PaginateData $paginate_dto = null)
 */

 interface Boq extends DataManagement
 {
     public function prepareStoreBoq(BoqData $boq_dto): Model;
     public function storeBoq(?BoqData $boq_dto = null): array;
     public function Boq(mixed $conditionals = null): Builder;
 }