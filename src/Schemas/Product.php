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

class Product extends PackageManagement implements ContractsProduct
{
    protected string $__entity = 'Product';
    public static $product_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'product',
            'tags'     => ['product', 'product-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return ['item'];
    }

    protected function showUsingRelation(): array{
        return [
            'item','materials'
        ];
    }

    public function getProduct(): mixed{
        return static::$product_model;
    }

    public function prepareShowProduct(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getProduct();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->product()->with($this->showUsingRelation())->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$product_model = $model;
    }    

    public function showProduct(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowProduct($model);
        });
    }

    public function prepareStoreProduct(ProductData $product_dto): Model{
        $product = $this->product()->updateOrCreate([
            'id' => $product_dto->id ?? null
        ],[
            'name' => $product_dto->name,
        ]);
        $product->load('item');

        foreach ($product_dto->props as $key => $prop) $product->{$key} = $prop;
        $item = $product->item;
        $product->item_id = $item->getKey();
        $product->sync($item,['id','name']);
        $product->save();

        if (isset($product_dto->item)){
            $item_dto       = &$product_dto->item;
            $item_dto->id   = $item->getKey();
            $item_dto->name = $product_dto->name;
            $this->schemaContract('Item')->prepareStoreItem($item_dto);
        }

        if (isset($product_dto->materials)){
            $bom_schema = $this->schemaContract('bom');
            foreach ($product_dto->materials as $material_dto) {
                $material = $this->schemaContract('material')->prepareStoreMaterial($material_dto);
                $bom_schema->prepareStoreBom($this->requestDTO(BomData::class,[
                    'item_id'      => $item->getKey(),
                    'material_id'  => $material->getKey()
                ]));
            }
        }

        return static::$product_model = $product;
    }

    public function storeProduct(? ProductData $product_dto = null): array{
        return $this->transaction(function() use ($product_dto) {
            return $this->showProduct($this->prepareStoreProduct($product_dto ?? $this->requestDTO(ProductData::class)));
        });
    }

    public function prepareViewProductPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->product()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewProductPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewProductPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewProductList(): Collection{
        return $this->product()->with($this->viewUsingRelation())->get();
    }

    public function viewProductList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewProductList();
        });
    }

    public function prepareDeleteProduct(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $product = $this->product()->findOrFail($attributes['id']);
        return $product->delete();
    }

    public function deleteProduct(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteProduct();
        });
    }

    public function product(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->ProductModel()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('name','asc');
    }
}

