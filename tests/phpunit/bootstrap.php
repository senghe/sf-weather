<?php

declare(strict_types=1);

require __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/Tests/AbstractKernelTestCase.php';
require_once __DIR__.'/Tests/AbstractWebTestCase.php';

exec('php bin/console doctrine:database:drop --force --env=test');
exec('php bin/console doctrine:database:create --env=test');
exec('php bin/console doctrine:schema:create --env=test');
