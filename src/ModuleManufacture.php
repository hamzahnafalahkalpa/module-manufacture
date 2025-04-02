<?php

namespace Hanafalah\ModuleManufacture;

use Hanafalah\LaravelSupport\Supports\PackageManagement;

class ModuleManufacture extends PackageManagement implements Contracts\ModuleManufacture
{
    /** @var array */
    protected $__module_manufacture_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('module-manufacture', $this->__module_manufacture_config);
    }
}
