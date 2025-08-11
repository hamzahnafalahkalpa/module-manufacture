<?php

namespace Hanafalah\ModuleManufacture\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleManufacture\Contracts\Data\BillOfMaterialData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleManufacture\Schemas\BillOfMaterial
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method mixed export(string $type)
 * @method bool deleteBillOfMaterial()
 * @method bool prepareDeleteBillOfMaterial(? array $attributes = null)
 * @method mixed getBillOfMaterial()
 * @method ?Model prepareShowBillOfMaterial(?Model $model = null, ?array $attributes = null)
 * @method array showBillOfMaterial(?Model $model = null)
 * @method Collection prepareViewBillOfMaterialList()
 * @method array viewBillOfMaterialList()
 * @method LengthAwarePaginator prepareViewBillOfMaterialPaginate(PaginateData $paginate_dto)
 * @method array viewBillOfMaterialPaginate(?PaginateData $paginate_dto = null)
 * @method array storeBillOfMaterial(?BillOfMaterialData $bill_of_material_dto = null)
 */
 interface BillOfMaterial extends DataManagement
 {
     public function prepareStoreBillOfMaterial(BillOfMaterialData $bill_of_material_dto): Model;
 }