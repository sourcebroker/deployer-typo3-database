deployer-typo3-database
=======================

      .. image:: http://img.shields.io/packagist/v/sourcebroker/deployer-typo3-database.svg?style=flat
         :target: https://packagist.org/packages/sourcebroker/deployer-extended-typo3

      .. image:: https://img.shields.io/badge/license-MIT-blue.svg?style=flat
         :target: https://packagist.org/packages/sourcebroker/deployer-typo3-database

.. contents:: :local:


Notice (!!!)
------------
This is experimental package for now. Do not use it yet.


What does it do?
----------------

This package provides settings to use `sourcebroker/deployer-extended_database`_ package with TYPO3 CMS.
It allows to sync database between instances.

Installation
------------

1) Install package with composer:
   ::

      composer require sourcebroker/deployer-typo3-database


2) Put following lines on the beginning of your deploy.php:
   ::

      require_once(__DIR__ . '/vendor/sourcebroker/deployer-loader/autoload.php');
      new \SourceBroker\DeployerTypo3Database\Loader();

3) On each instance create ``.env`` file which should be out of git and have at least ``INSTANCE`` with the same name as
   defined for ``host()`` in ``deploy.php`` file. You can use this file also to store database credentials and all other
   settings that are different per instance. Example for ``.env`` file:

   ::

      TYPO3_CONTEXT='Production//Live'
      INSTANCE='live'

      TYPO3__DB__Connections__Default__dbname='t3base11_live'
      TYPO3__DB__Connections__Default__host='127.0.0.1'
      TYPO3__DB__Connections__Default__password='password'
      TYPO3__DB__Connections__Default__port='3306'
      TYPO3__DB__Connections__Default__user='t3base11_live'



   If you want that Deployer get database data from TYPO3 directly instead of reading from .env file then set:
   ::

      set('driver_typo3cms', true);



Synchronizing database
----------------------

The command for synchronizing database from live database to local instance is:
::

   dep db:pull live

   dep db:copy live --options=target:beta


Example of working configuration
--------------------------------

This is example of working configuration for TYPO3 13.

::

  <?php

  namespace Deployer;

  require_once(__DIR__ . '/vendor/sourcebroker/deployer-loader/autoload.php');

  new \SourceBroker\DeployerTypo3Database\Loader();

  host('live')
      ->setHostname('vm-dev.example.com')
      ->setRemoteUser('deploy')
      ->set('bin/php', '/home/www/t3base11-public/live/.bin/php');
      ->set('deploy_path', '/home/www/t3base11/live');

  host('beta')
      ->setHostname('vm-dev.example.com')
      ->setRemoteUser('deploy')
      ->set('bin/php', '/home/www/t3base11-public/beta/.bin/php');
      ->set('deploy_path', '/home/www/t3base11/beta');

  localhost('local')
      ->set('bin/php', 'php')
      ->set('deploy_path', getcwd());

  ?>


Changelog
---------

See https://github.com/sourcebroker/deployer-typo3-database/blob/master/CHANGELOG.rst


.. _sourcebroker/deployer-extended-database: https://github.com/sourcebroker/deployer-typo3-database