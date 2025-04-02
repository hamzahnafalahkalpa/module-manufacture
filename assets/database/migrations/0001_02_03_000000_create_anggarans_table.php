<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;
use Hanafalah\ModuleCms\Enums\Article\Status;
use Hanafalah\ModuleManufacture\Models\Anggaran\Anggaran;

return new class extends Migration
{
    use NowYouSeeMe;

    private $__table;

    public function __construct()
    {
        $this->__table = app(config('database.models.Anggaran', Anggaran::class));
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()) {
            Schema::create($table_name, function (Blueprint $table) {
                $table->ulid('id')->primary();
                $table->string('article_code',50)->nullable();
                $table->string('flag',100)->nullable(false);
                $table->string('title',255);
                $table->mediumText('sub_title');
                $table->string('status',50)->default(Status::DRAFT)->nullable(false);
                $table->string('author_type',50)->nullable();
                $table->string('author_id',36)->nullable();
                $table->timestamp('published_at')->nullable();
                $table->timestamp('archived_at')->nullable();
                $table->json('props')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });

            Schema::table($table_name, function (Blueprint $table) {
                $table->foreignIdFor(get_class($this->__table), 'parent_id')
                      ->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
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
