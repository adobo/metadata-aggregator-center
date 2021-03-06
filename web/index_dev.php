<?php

use Symfony\Component\Debug\Debug;

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
$dev_enabled = getenv('MB_DEV_ENABLE');
if ($dev_enabled === false) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/dev.php';
if (file_exists(__DIR__ . '/../config/settings.php')) {
    require __DIR__.'/../config/settings.php';
}

require __DIR__.'/../src/controllers.php';
$app->run();
