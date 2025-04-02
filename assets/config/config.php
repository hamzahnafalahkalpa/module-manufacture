<?php

use Hanafalah\ModuleManufacture\{
    Models as ModuleManufactureModels,
    Commands as ModuleManufactureCommands,
    Contracts
};

return [
    'app' => [
        'contracts' => [
            // ADD YOUR CONTRACTS HERE
        ],
    ],
    'commands' => [
        ModuleManufactureCommands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas'
    ],
    'database' => [
        'models' => [
            // ADD YOUR MODELS HERE
        ]
    ]
];
