<?php

use Core\App;

define("APP_PATH", dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

$app = App::getInstance();

$app->run();