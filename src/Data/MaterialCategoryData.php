<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData as DataMaterialCategoryData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class MaterialCategoryData extends Data implements DataMaterialCategoryData{
    public function __construct(
        #[MapName('id')]
        #[MapInputName('id')]
        public mixed $id = null,

        #[MapName('parent_id')]
        #[MapInputName('parent_id')]
        public mixed $parent_id = null,

        #[MapName('name')]
        #[MapInputName('name')]
        public ?string $name = null,

        #[MapName('note')]
        #[MapInputName('note')]
        public ?string $note = null
    ){}
}
