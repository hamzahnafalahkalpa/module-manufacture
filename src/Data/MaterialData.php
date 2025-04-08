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
    #[MapName('id')]    
    #[MapInputName('id')]
    #[RequiredWithout('item')]
    public mixed $id = null;

    #[MapName('name')]    
    #[MapInputName('name')]
    public ?string $name = null;

    #[MapName('material_category_id')]    
    #[MapInputName('material_category_id')]
    public mixed $material_category_id = null;

    #[MapName('item')]    
    #[MapInputName('item')]
    public ?ItemData $item = null;

    #[MapName('props')]    
    #[MapInputName('props')]
    public ?array $props = [];

    public static function after(MaterialData $data): MaterialData{
        $new = self::new();
        $data->props['prop_material_category'] = [
            'id'   => null,
            'name' => null
        ];
        if (isset($data->material_category_id)){
            $material_category = $new->MaterialCategoryModel()->findOrFail($data->material_category_id);
            $data->props['prop_material_category'] = [
                'id'   => $material_category->getKey(),
                'name' => $material_category->name
            ];
        }

        if (!isset($data->item) && isset($data->id)){
            $material   = $new->MaterialModel()->findOrFail($data->id);
            $item       = $material->item;
            $data->item = $new->requestDTO(ItemData::class,['id' => $item->getKey(),'name' => $item->name]);
        }
        $data->name = $data->item->name;
        return $data;
    }
}
