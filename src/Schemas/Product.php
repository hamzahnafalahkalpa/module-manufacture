<?php

namespace Hanafalah\ModuleManufacture\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleManufacture\Contracts\Data\BomData;
use Hanafalah\ModuleManufacture\Contracts\Schemas\Product as ContractsProduct;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleManufacture\Contracts\Data\ProductData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Product extends Material implements ContractsProduct
{
    protected string $__entity = 'Product';
    public $product_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'product',
            'tags'     => ['product', 'product-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStoreProduct(ProductData $product_dto): Model{
        $product = $this->prepareStoreMaterial($product_dto);
        $this->fillingProps($product,$product_dto->props);
        $product->save();
        return $this->product_model = $product;
    }
}

