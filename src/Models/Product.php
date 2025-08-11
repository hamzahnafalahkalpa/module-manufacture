<?php

namespace Hanafalah\ModuleManufacture\Models;

use Hanafalah\ModuleManufacture\Resources\Product\{ViewProduct, ShowProduct};

class Product extends Material{
    protected $table = 'materials';

    public function getViewResource(){
        return ViewProduct::class;
    }

    public function getShowResource(){
        return ShowProduct::class;
    }

    protected function isUsingService(): bool{
        return true;
    }
}