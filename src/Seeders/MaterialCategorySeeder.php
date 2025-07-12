<?php

namespace Hanafalah\ModuleManufacture\Seeders;

use Illuminate\Database\Seeder;
use Hanafalah\ModuleManufacture\Models\MaterialCategory;

class MaterialCategorySeeder extends Seeder
{
    private $__material_categories = [];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->__material_categories = include_once __DIR__ . '/data/material_categories.php';

        foreach ($this->__material_categories as $category) {
            $this->createCategory($category);
        }
    }

    /**
     * Recursive function to create categories and their children.
     */
    private function createCategory(array $category, $parent_id = null)
    {
        $createdCategory = app(config('database.models.MaterialCategory'))->UpdateOrCreate([
            'name' => $category['name'],
        ], [
            'parent_id' => $parent_id ?? null
        ]);
        $createdCategory->note = $category['note'];
        $createdCategory->save();
        if (!empty($category['childs'])) {
            foreach ($category['childs'] as $child) {
                $this->createCategory($child, $createdCategory->id);
            }
        }
    }
}
