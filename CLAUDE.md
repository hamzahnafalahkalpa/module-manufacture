# CLAUDE.md - Module Manufacture

This file provides guidance to Claude Code when working with this module.

## Overview

`hanafalah/module-manufacture` is a Laravel package for managing manufacturing-related entities including materials, products, bill of materials (BOM), and bill of quantities (BOQ). It provides a complete manufacturing/inventory management solution for tracking raw materials, semi-finished goods, and finished products.

## CRITICAL: Memory Warning

**This module uses `registers(['*'])` in its ServiceProvider, which can cause memory issues.**

```php
// ModuleManufactureServiceProvider.php
public function register()
{
    $this->registerMainClass(ModuleManufacture::class)
        ->registerCommandService(Providers\CommandServiceProvider::class)
        ->registers(['*']);  // Uses wildcard registration
}
```

The `registers(['*'])` call auto-registers safe methods only (Config, Model, Database, Migration, Route, Namespace, Provider). However, if you modify this to include `Schema` or `Services`, you may trigger memory exhaustion issues.

**Safe Pattern (if modification needed):**
```php
public function register()
{
    $this->registerMainClass(ModuleManufacture::class)
        ->registerCommandService(Providers\CommandServiceProvider::class);
    // Register services manually with closures for deferred loading
}
```

## Architecture Overview

```
module-manufacture/
├── src/
│   ├── ModuleManufactureServiceProvider.php  # Main service provider
│   ├── ModuleManufacture.php                 # Main class (extends PackageManagement)
│   ├── Contracts/
│   │   ├── ModuleManufacture.php             # Main contract interface
│   │   ├── Schemas/                          # Schema contracts
│   │   │   ├── Material.php
│   │   │   ├── Product.php
│   │   │   ├── BillOfMaterial.php
│   │   │   ├── Boq.php
│   │   │   └── MaterialCategory.php
│   │   └── Data/                             # Data transfer object contracts
│   ├── Schemas/                              # Business logic classes
│   │   ├── Material.php                      # Material CRUD operations
│   │   ├── Product.php                       # Product operations (extends Material)
│   │   ├── BillOfMaterial.php                # BOM operations
│   │   ├── Boq.php                           # BOQ operations
│   │   └── MaterialCategory.php              # Category management
│   ├── Models/                               # Eloquent models
│   │   ├── Material.php                      # Raw materials/components
│   │   ├── Product.php                       # Finished products (extends Material)
│   │   ├── BillOfMaterial.php                # BOM linking products to materials
│   │   ├── Boq.php                           # Bill of Quantities for costing
│   │   └── MaterialCategory.php              # Category taxonomy (uses Unicode)
│   ├── Data/                                 # Spatie Data DTOs
│   │   ├── MaterialData.php
│   │   ├── ProductData.php
│   │   ├── BillOfMaterialData.php
│   │   ├── BoqData.php
│   │   └── MaterialCategoryData.php
│   ├── Resources/                            # API Resources for response formatting
│   │   ├── Material/
│   │   ├── Product/
│   │   ├── BillOfMaterial/
│   │   ├── Boq/
│   │   └── MaterialCategory/
│   ├── Commands/
│   │   ├── InstallMakeCommand.php            # Installation artisan command
│   │   └── EnvironmentCommand.php
│   ├── Providers/
│   │   └── CommandServiceProvider.php
│   ├── Facades/
│   │   └── ModuleManufacture.php
│   └── Seeders/
│       ├── MaterialCategorySeeder.php
│       └── data/material_categories.php      # Default category data
└── assets/
    ├── config/config.php                     # Module configuration
    └── database/migrations/
        ├── 0001_02_03_000002_create_materials_table.php
        └── 0001_02_03_000003_create_bill_of_materials_table.php
```

## Domain Model Architecture

The module implements a hierarchical manufacturing structure:

```
Product (finished goods)
├── hasMany: BOMs (Bill of Materials)
│   └── BOM links product to required materials with quantities
│
Material (raw materials, components)
├── belongsTo: MaterialCategory
├── morphsTo: Item (from module-item for inventory tracking)
└── hasMany: BOMItems

MaterialCategory (taxonomy)
└── hasMany: Materials (hierarchical with parent_id)

Boq (Bill of Quantities)
├── belongsTo: Shbj (cost calculation reference)
└── attributes: volume, unit_id, price
```

## Key Classes

### Models

| Model | Table | Description |
|-------|-------|-------------|
| `Material` | `materials` | Base model for raw materials and components |
| `Product` | `materials` | Extends Material with `flag='Product'` for finished goods |
| `BillOfMaterial` | `bill_of_materials` | Polymorphic linking of products to materials |
| `Boq` | `boqs` | Bill of Quantities for detailed costing |
| `MaterialCategory` | `unicodes` | Uses Unicode table for hierarchical categories |

### Schemas (Business Logic)

| Schema | Purpose |
|--------|---------|
| `Material` | CRUD for materials with Item integration |
| `Product` | Extends Material schema for products |
| `BillOfMaterial` | Manages BOM relationships and quantities |
| `Boq` | Bill of Quantities calculations |
| `MaterialCategory` | Category management (extends Unicode schema) |

### Data Transfer Objects (DTOs)

All DTOs extend `Hanafalah\LaravelSupport\Supports\Data` and use Spatie Laravel Data:

- `MaterialData` - Material creation/update with nested `ItemData` support
- `ProductData` - Extends MaterialData with `flag='Product'`
- `BillOfMaterialData` - BOM entries with material references
- `BoqData` - BOQ entries with pricing
- `MaterialCategoryData` - Category with hierarchical support

## Dependencies

```json
{
    "require": {
        "hanafalah/laravel-support": "dev-main",
        "hanafalah/module-item": "dev-main"
    }
}
```

**Key Dependencies:**
- `laravel-support` - Base classes, traits, and utilities
- `module-item` - Item management for inventory integration (barcode, stock, pricing)

## Configuration

Configuration file at `assets/config/config.php`:

```php
return [
    'app' => [
        'contracts' => [
            // Contract => Implementation bindings
        ],
    ],
    'commands' => [
        ModuleManufactureCommands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            // Override model classes here if needed
        ]
    ]
];
```

## Database Schema

### Materials Table

```php
Schema::create('materials', function (Blueprint $table) {
    $table->ulid('id')->primary();
    $table->string('material_code')->nullable();     // Auto-generated code
    $table->string('name', 255)->nullable();
    $table->string('flag', 100)->nullable();         // 'Material' or 'Product'
    $table->foreignIdFor(MaterialCategory::class)->nullable();
    $table->json('props')->nullable();               // Flexible properties
    $table->timestamps();
    $table->softDeletes();
});
```

### Bill of Materials Table

```php
Schema::create('bill_of_materials', function (Blueprint $table) {
    $table->ulid('id')->primary();
    $table->string('bill_type', 50);                 // Polymorphic type (Product/Material)
    $table->string('bill_id', 36);                   // Parent product/material ID
    $table->string('material_type', 50);             // Component type
    $table->string('material_id', 36);               // Component ID
    $table->decimal('coefficient', 3, 2)->nullable(); // Conversion factor
    $table->decimal('qty', 7, 2);                    // Required quantity
    $table->json('props')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

## Usage Patterns

### Creating a Material

```php
use Hanafalah\ModuleManufacture\Facades\ModuleManufacture;
use Hanafalah\ModuleManufacture\Data\MaterialData;

// Using Schema contract
$schema = ModuleManufacture::useSchema('material');
$material = $schema->storeMaterial(MaterialData::from([
    'name' => 'Steel Sheet',
    'material_category_id' => $categoryId,
    'item' => [
        'selling_price' => 100000,
        'unit_id' => $unitId
    ]
]));
```

### Creating a Product with BOM

```php
$schema = ModuleManufacture::useSchema('product');
$product = $schema->prepareStoreProduct(ProductData::from([
    'name' => 'Metal Cabinet',
    'material_category_id' => $categoryId,
    'bill_of_materials' => [
        ['material_id' => $steelId, 'material_type' => 'Material', 'qty' => 2.5],
        ['material_id' => $screwId, 'material_type' => 'Material', 'qty' => 20],
    ]
]));
```

### Querying Materials

```php
$schema = ModuleManufacture::useSchema('material');

// Get material builder with conditionals
$materials = $schema->material(['name' => 'Steel'])->get();

// With pagination
$paginated = $schema->viewMaterialPaginate();
```

## Item Integration

Materials and Products integrate with `module-item` for inventory management:

```php
// Material model
public function item()
{
    return $this->morphOneModel('Item', 'reference');
}
```

The Item model (from module-item) provides:
- Barcode/SKU management
- Stock tracking
- Selling price
- Unit of measurement
- Cost of goods sold (COGS) calculation

## Material Category Hierarchy

Categories use the Unicode model for hierarchical taxonomy:

```php
// Example categories from seeder
[
    'name' => 'Bahan Baku',          // Raw Materials
    'childs' => [
        ['name' => 'Kayu'],          // Wood
        ['name' => 'Logam'],         // Metal
        ['name' => 'Plastik'],       // Plastic
    ]
],
[
    'name' => 'Material Medis & Farmasi',  // Medical Materials
    'childs' => [
        ['name' => 'Bahan Baku Obat'],
        ['name' => 'Peralatan Medis'],
    ]
]
```

## Artisan Commands

```bash
# Install module (publish config and migrations)
php artisan module-manufacture:install
```

## Common Patterns

### Extending Material for Custom Types

```php
// Product.php already extends Material
class Product extends Material
{
    protected $table = 'materials';

    // Uses flag='Product' for differentiation
}

// Create your own variants similarly
class Component extends Material
{
    protected $table = 'materials';

    protected static function booted(): void
    {
        parent::booted();
        static::creating(fn($q) => $q->flag ??= 'Component');
        static::addGlobalScope('flag', fn($q) => $q->flagIn('Component'));
    }
}
```

### Caching Configuration

Schemas include built-in caching configuration:

```php
protected array $__cache = [
    'index' => [
        'name'     => 'material',
        'tags'     => ['material', 'material-index'],
        'duration' => 60 * 24 * 7  // 7 days
    ]
];
```

## Safe Development Patterns

### When Modifying ServiceProvider

```php
// SAFE - explicit registration
public function register()
{
    $this->registerMainClass(ModuleManufacture::class);

    // Manually register what you need
    $this->app->singleton(
        Contracts\Schemas\Material::class,
        fn() => new Schemas\Material()
    );
}
```

### When Creating New Schemas

```php
// Extend PackageManagement safely
class MySchema extends PackageManagement
{
    protected string $__entity = 'MyEntity';

    // Don't call config() in constructor
    // Use lazy initialization
    public function myQuery(mixed $conditionals = null): Builder
    {
        $this->booting();  // Initialize when needed
        return $this->MyEntityModel()->conditionals($conditionals);
    }
}
```

## Testing Changes

```bash
# Clear caches after changes
docker exec -it wellmed-backbone php artisan config:clear
docker exec -it wellmed-backbone php artisan cache:clear
docker exec -it wellmed-backbone php artisan octane:reload

# Run seeder for test data
docker exec -it wellmed-backbone php artisan db:seed --class=Hanafalah\\ModuleManufacture\\Seeders\\MaterialCategorySeeder
```

## Integration with Octane

Since this module uses `PackageManagement` which includes `HasModelConfiguration`, be aware of Octane state concerns:

- Don't store tenant-specific data in static properties
- The `$material_model`, `$product_model` etc. properties in Schemas are per-request
- Ensure FlushTenantState listener handles any module-specific cleanup if needed

## Troubleshooting

### "Model not found" Errors

Ensure the model is registered in config:
```php
// config/database.php or module config
'database' => [
    'models' => [
        'Material' => \Hanafalah\ModuleManufacture\Models\Material::class,
        'Product' => \Hanafalah\ModuleManufacture\Models\Product::class,
    ]
]
```

### Memory Issues on Boot

If experiencing memory exhaustion:
1. Check if `registers(['Schema'])` is being used
2. Remove explicit Schema registration
3. Use manual singleton registration with closures

### BOM Not Saving

Ensure polymorphic types match:
```php
// bill_type must match the morph class
$bom_dto->bill_type = $product->getMorphClass();  // Usually 'Product'
$bom_dto->material_type = $material->getMorphClass();  // Usually 'Material'
```
