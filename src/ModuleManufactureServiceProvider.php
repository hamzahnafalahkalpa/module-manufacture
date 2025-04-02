<?php

declare(strict_types=1);

namespace Hanafalah\ModuleManufacture;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModuleManufactureServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     * 
     * @return $this
     */
    public function register()
    {
        $this->registerMainClass(ModuleManufacture::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers(['*']);
    }
    

    /**
     * Get the base path of the package.
     *
     * @return string
     */
    protected function dir(): string
    {
        return __DIR__ . '/';
    }

    protected function migrationPath(string $path = ''): string
    {
        return database_path($path);
    }
}
