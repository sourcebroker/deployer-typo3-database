<?php

namespace Deployer;

set('local/bin/typo3', function () {
    if (file_exists('./composer.json')) {
        $composerConfig = json_decode(file_get_contents('./composer.json'), true, 512, JSON_THROW_ON_ERROR);
        if ($composerConfig['config']['bin-dir'] ?? false) {
            return $composerConfig['config']['bin-dir'] . '/typo3';
        }
    }
    return file_exists('./vendor/bin/typo3cms') ? 'vendor/bin/typo3cms' : 'vendor/bin/typo3';
});

set('db_ddev_database_config', [
    'host' => 'db',
    'port' => $_ENV['DDEV_HOST_DB_PORT'] ?? null,
    'dbname' => 'db',
    'user' => 'db',
    'password' => 'db',
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_default', [
    'ignore_tables_out' => [
        'cf_.*',
        'cache_.*',
        'be_sessions',
        'fe_sessions',
        'fe_session_data',
        'sys_file_processedfile',
        'sys_refindex',
        'tx_devlog',
        'tx_extensionmanager_domain_model_extension',
        'tx_solr_.*',
        'tx_crawler_queue',
        'tx_crawler_process',
    ],
    'post_sql_in' => '',
    'post_sql_in_markers' => ''
]);

// Look https://github.com/sourcebroker/deployer-extended-database for docs
set('db_databases',
    [
        'database_default' => [
            get('db_default'),
            function () {
                if (get('driver_typo3cms', false)) {
                    return (new \SourceBroker\DeployerTypo3Database\Drivers\Typo3CmsDriver)->getDatabaseConfig();
                }
                return !empty($_ENV['IS_DDEV_PROJECT']) ? get('db_ddev_database_config') :
                    (new \SourceBroker\DeployerTypo3Database\Drivers\Typo3EnvDriver)->getDatabaseConfig(
                        [
                            'host' => 'TYPO3__DB__Connections__Default__host',
                            'port' => 'TYPO3__DB__Connections__Default__port',
                            'dbname' => 'TYPO3__DB__Connections__Default__dbname',
                            'user' => 'TYPO3__DB__Connections__Default__user',
                            'password' => 'TYPO3__DB__Connections__Default__password',
                            'ssl_key' => 'TYPO3__DB__Connections__Default__ssl_key',
                            'ssl_cert' => 'TYPO3__DB__Connections__Default__ssl_cert',
                            'ssl_ca' => 'TYPO3__DB__Connections__Default__ssl_ca',
                            'ssl_capath' => 'TYPO3__DB__Connections__Default__ssl_capath',
                            'ssl_cipher' => 'TYPO3__DB__Connections__Default__ssl_cipher',
                            'flags' => 'TYPO3__DB__Connections__Default__driverOptions__flags'
                        ]
                    );
            }
        ]
    ]
);
