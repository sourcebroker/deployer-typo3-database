<?php

namespace SourceBroker\DeployerTypo3Database\Drivers;

use SourceBroker\DeployerInstance\Env;

class Typo3EnvDriver
{
    public function getDatabaseConfig(array $dbMappingFields = null, string $absolutePathWithConfig = null): array
    {
        $env = new Env();
        $env->load($absolutePathWithConfig);
        $dbSettings = [];
        foreach ($dbMappingFields as $key => $dbMappingField) {
            $dbSettings[$key] = $env->get($dbMappingField);
        }
        return $dbSettings;
    }
}
