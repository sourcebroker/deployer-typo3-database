<?php

namespace SourceBroker\DeployerTypo3Database;

use SourceBroker\DeployerLoader\Load;

class Loader
{
    public function __construct()
    {
        require_once 'recipe/common.php';
        new Load([
                ['path' => 'vendor/sourcebroker/deployer-instance/deployer'],
                ['path' => 'vendor/sourcebroker/deployer-extended-database/deployer'],
                ['path' => 'vendor/sourcebroker/deployer-typo3-database/deployer'],
            ]
        );
    }
}
