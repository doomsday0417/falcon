<?php
defined('PATH')
|| define('PATH', realpath(dirname(__FILE__) . '/../'));

defined('APP_PATH')
|| define('APP_PATH', PATH . '/application');

defined('WWW_ROOT')
|| define('WWW_ROOT', PATH . '/../../');

defined('CACHE_PATH')
|| define('CACHE_PATH', PATH . '/../../../caches');

defined('LOG_PATH')
|| define('LOG_PATH', PATH . '/../../../logs');


$app = new Yaf_Application(
        APP_PATH . '/configs/application.ini'
);

$app->bootstrap()->run();