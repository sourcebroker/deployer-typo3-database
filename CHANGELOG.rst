
Changelog
---------

1.1.0
-----

1) [TASK] Extend `ignore_tables_out` with `sys_http_report` as it can get quite big and, 99% of the time, it's not
   required in the dev environment (thanks to @mikestreety)

1.0.0
-----

1) [TASK] Clean up composer.json, gitignore.
2) [TASK] Release first stable version.

0.0.8
-----

1) [TASK][BREAKING] Remove some tables from dump exclude. They can affect size of backups and GDPR.
   Tables removed from exclude: 'sys_history', 'sys_log', 'tx_powermail_domain_model_mail', 'tx_powermail_domain_model_answer'.
   If needed they should be included on higher level custom package.

0.0.7
-----

1) [TASK][BREAKING] Update to breaking change of ``sourcebroker/deployer-instance``.

0.0.6
-----

1) [TASK][BREAKING] Drop requirement to ``helhum/dotenv-connector`` as ``sourcebroker/deployer-instance`` is acting.
   Drop requirement to ``deployer/deployer`` as is already declared at ``sourcebroker/deployer-extended-database``.
   Clean up composer.json.

2) [TASK][BREAKING] Remove disabling push to top instances and backup settings. This should be part of higher, custom package.

0.0.5
-----

1) [TASK][BREAKING] Update ``sourcebroker/deployer-extended-database`` dependency.

0.0.4
-----

1) [TASK] Drop requirement to ``typo3/cms-core`` to give better flexibility for support older TYPO3 versions.
2) [TASK] Add support to ``vendor/bin/typo3cms``.

0.0.3
-----

1) Fix wrong tag.

0.0.2
-----

1) Refactor loader.

0.0.1
~~~~~

1) Init version.