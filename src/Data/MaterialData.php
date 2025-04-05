<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleItem\Contracts\Data\ItemData;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialData as DataMaterialData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\RequiredWithout;
use Spatie\LaravelData\Contracts\BaseData;

class MaterialData extends Data implements DataMaterialData, BaseData{
    public function __construct(
        #[MapName('id')]    
        #[MapInputName('id')]
        #[RequiredWithout('item')]
        public mixed $id = null,

        #[MapName('name')]    
        #[MapInputName('name')]
        public ?string $name = null,

        #[MapName('material_category_id')]    
        #[MapInputName('material_category_id')]
        public mixed $material_category_id = null,

        #[MapName('item')]    
        #[MapInputName('item')]
        public ?ItemData $item = null,

        #[MapName('props')]    
        #[MapInputName('props')]
        public ?array $props = []
    ){
        $this->props['prop_material_category'] = [
            'id'   => null,
            'name' => null
        ];
        if (isset($this->material_category_id)){
            $material_category = $this->MaterialCategoryModel()->findOrFail($this->material_category_id);
            $this->props['prop_material_category'] = [
                'id'   => $material_category->getKey(),
                'name' => $material_category->name
            ];
        }

        if (!isset($this->item) && isset($this->id)){
            $material   = $this->MaterialModel()->findOrFail($this->id);
            $item       = $material->item;
            $this->item = $this->requestDTO(ItemData::class,['id' => $item->getKey(),'name' => $item->name]);
        }
        $this->name = $this->item->name;
    }
}
