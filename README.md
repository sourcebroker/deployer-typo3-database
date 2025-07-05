
deployer-typo3-database
=======================

[![Latest Stable Version](http://img.shields.io/packagist/v/sourcebroker/deployer-typo3-database.svg?style=flat)](https://packagist.org/packages/sourcebroker/deployer-typo3-database)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://packagist.org/packages/sourcebroker/deployer-typo3-database)


## What does it do?

This package provides settings to use package [sourcebroker/deployer-extended-database](https://github.com/sourcebroker/deployer-extended-database) with TYPO3 CMS.
It allows to sync database between instances.

## Installation

1. Install package with composer:

   ```
   composer require sourcebroker/deployer-typo3-database
   ```

2. Put the following lines at the beginning of your `deploy.php`:

   ```php
   require_once(__DIR__ . '/vendor/autoload.php');
   new \SourceBroker\DeployerLoader\Loader([
     ['get' => 'sourcebroker/deployer-typo3-database'],
   ]);
   ```

3. On each instance create a `.env` (or `.env.local`) file which should be out of git and have at least `INSTANCE` with the same name as defined for `host()` in `deploy.php`. You can use this file also to store database credentials and any other settings that are different per instance. Example for `.env` file:

   ```bash
   TYPO3_CONTEXT='Production'
   INSTANCE='production'

   TYPO3__DB__Connections__Default__dbname='t3base13_production'
   TYPO3__DB__Connections__Default__host='127.0.0.1'
   TYPO3__DB__Connections__Default__password='password'
   TYPO3__DB__Connections__Default__port='3306'
   TYPO3__DB__Connections__Default__user='t3base13_production'
   ```

   If you want Deployer to get database data from TYPO3 directly instead of reading from `.env` file then set:

   ```php
   set('driver_typo3cms', true);
   ```

   As an alternative you can also not create any `.env` file but make sure that the env variable `INSTANCE` exists in the system at hosts defined in Deployer (and also at your local host). For example, at local ddev level you can define it in `.ddev/config.yaml`:

   ```yaml
   web_environment:
     - INSTANCE=local
   ```


## Synchronizing database

The command for synchronizing database from production database to local instance is:

```bash
dep db:pull production
```

The command for synchronizing database from production to staging is:

```bash
dep db:copy production --options=target:staging
```


## Example of working configuration

This is an example of working configuration for TYPO3 13:

```php
<?php

namespace Deployer;

require_once(__DIR__ . '/vendor/autoload.php');

new \SourceBroker\DeployerLoader\Loader([
  ['get' => 'sourcebroker/deployer-typo3-database'],
]);

host('production')
    ->setHostname('vm-dev.example.com')
    ->setRemoteUser('deploy')
    ->set('bin/php', '/usr/bin/php8.4');
    ->set('deploy_path', '~/t3base13/production');

host('staging')
    ->setHostname('vm-dev.example.com')
    ->setRemoteUser('deploy')
    ->set('bin/php', '/usr/bin/php8.4');
    ->set('deploy_path', '~/t3base13/staging');
```


## Changelog

See [CHANGELOG.rst](https://github.com/sourcebroker/deployer-typo3-database/blob/master/CHANGELOG.rst)

