<?php

namespace Hanafalah\ModuleManufacture\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleManufacture\Contracts\Data\JasaData as DataJasaData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class JasaData extends Data implements DataJasaData{
    public function __construct(
        #[MapName('id')]
        #[MapInputName('id')]
        public mixed $id = null,
    
        #[MapName('name')]
        #[MapInputName('name')]
        public string $name,
    
        #[MapName('note')]
        #[MapInputName('note')]
        public ?string $note = null
    ){}
}
