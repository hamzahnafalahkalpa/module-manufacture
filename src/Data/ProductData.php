<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleItem\Contracts\Data\ItemData;
use Hanafalah\ModuleManufacture\Contracts\Data\ProductData as DataProductData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ProductData extends Data implements DataProductData{
    public function __construct(
        #[MapName('id')]    
        #[MapInputName('id')]
        public mixed $id,

        #[MapName('name')]    
        #[MapInputName('name')]
        public string $name,

        #[MapName('item')]    
        #[MapInputName('item')]
        public ItemData $item,

        #[MapName('materials')]    
        #[MapInputName('materials')]
        #[DataCollectionOf(MaterialData::class)]
        public array $materials,

        #[MapName('props')]    
        #[MapInputName('props')]
        public ?array $props = [],
    ){}
}
