<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleItem\Contracts\Data\ItemData;
use Hanafalah\ModuleManufacture\Contracts\Data\MaterialCategoryData;
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

    #[MapName('material_category')]    
    #[MapInputName('material_category')]
    public ?MaterialCategoryData $material_category = null;

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
        if (isset($data->material_category_id) || !isset($data->material_category)){
            if (isset($data->material_category_id)) {
                $material_category = $new->MaterialCategoryModel()->findOrFail($data->material_category_id);
            }elseif(isset($data->material_category)){
                $material_category = $new->MaterialCategoryModel()->findOrCreate([
                    'name'       => $data->material_category['name'],
                    'parent_id'  => $data->material_category['parent_id'] ?? null,
                    'note'       => $data->material_category['note'] ?? null,
                ]);
            }
            if (isset($material_category)){
                $data->props['prop_material_category'] = [
                    'id'   => $material_category->getKey(),
                    'name' => $material_category->name
                ];
            }
        }

        return $data;
    }
}
