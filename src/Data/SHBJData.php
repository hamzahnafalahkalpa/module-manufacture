<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleManufacture\Contracts\Data\SHBJData as DataSHBJData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class SHBJData extends Data implements DataSHBJData{
    public function __construct(
        #[MapName('id')]
        #[MapInputName('id')]
        public mixed $id = null,

        #[MapName('name')]
        #[MapInputName('name')]
        public ?string $name = null,

        #[MapName('reference_type')]
        #[MapInputName('reference_type')]
        public string $reference_type,
    
        #[MapName('reference_id')]
        #[MapInputName('reference_id')]
        public mixed $reference_id,
    
        #[MapName('reference')]
        #[MapInputName('reference')]
        public ?array $reference = null,
    
        #[MapName('flag')]
        #[MapInputName('flag')]
        public string $flag,
    
        #[MapName('price')]
        #[MapInputName('price')]
        public int $price = 0
    ){
        if (isset($this->reference_id,$this->reference_type)){
            $model = $this->{$this->reference_type.'Model'}()->find($this->reference_id);
            if (isset($model)){
                $this->reference = [
                    'id'   => $model->getKey(),
                    'name' => $model->name
                ];
                $this->name = $model->name;
            }else{
                if (!isset($this->name)){
                    throw new \Exception('name is required');
                }
            }
        }
    }
}
