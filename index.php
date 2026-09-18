<?php
declare(strict_types=1);

define('BASE_PATH', __DIR__);

require BASE_PATH . '/app/core.php';
require BASE_PATH . '/app/controller.php';

$router = new Router();
require BASE_PATH . '/routes/web.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);