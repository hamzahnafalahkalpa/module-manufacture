<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleManufacture\Contracts\Data\BillOfMaterialData as DataBillOfMaterialData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Attributes\Validation\RequiredWithoutAll;
use Spatie\LaravelData\Contracts\BaseData;

class BillOfMaterialData extends Data implements DataBillOfMaterialData, BaseData{
    #[MapName('id')]    
    #[MapInputName('id')]
    #[RequiredWithoutAll('item_id','material_id')]
    public mixed $id = null;

    #[MapName('item_id')]    
    #[MapInputName('item_id')]
    #[RequiredWithout('id')]
    public mixed $item_id = null;

    #[MapName('material_id')]    
    #[MapInputName('material_id')]
    #[RequiredWithout('id')]
    public mixed $material_id = null;

    #[MapName('props')]    
    #[MapInputName('props')]
    public ?array $props = [];
}
