<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleManufacture\Contracts\Data\BoqData as DataBoqData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class BoqData extends Data implements DataBoqData{
    #[MapName('id')]    
    #[MapInputName('id')]
    public mixed $id;
    
    #[MapName('shbj_id')]    
    #[MapInputName('shbj_id')]
    public ?string $shbj_id = null;
    
    #[MapName('name')]    
    #[MapInputName('name')]
    public string $name;
    
    #[MapName('volume')]    
    #[MapInputName('volume')]
    public string $volume;
    
    #[MapName('unit_id')]    
    #[MapInputName('unit_id')]
    public mixed $unit_id = null;
    
    #[MapName('unit_name')]    
    #[MapInputName('unit_name')]
    public string $unit_name;
    
    #[MapName('price')]    
    #[MapInputName('price')]
    public int $price;
}
