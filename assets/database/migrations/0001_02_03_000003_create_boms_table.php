<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;
use Hanafalah\ModuleManufacture\Models\Bom;

return new class extends Migration
{
    use NowYouSeeMe;

    private $__table;

    public function __construct()
    {
        $this->__table = app(config('database.models.Bom', Bom::class));
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()) {
            Schema::create($table_name, function (Blueprint $table) {
                $item     = app(config('database.models.Item'));
                $material = app(config('database.models.Material'));

                $table->ulid('id')->primary();
                $table->foreignIdFor($item::class)
                      ->constrained($item->getTable(),$item->getKeyName(),'itm_bom')
                      ->cascadeOnDelete()->cascadeOnUpdate();

                $table->foreignIdFor($material::class)
                      ->constrained($material->getTable(),$material->getKeyName(),'mtr_bom')
                      ->cascadeOnDelete()->cascadeOnUpdate();

                $table->json('props')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
