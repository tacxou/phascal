<?php
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    $di = new FactoryDefault;

    include APP_PATH . '/config/router.php';
    include APP_PATH . '/config/services.php';

    $config = $di->get('config');
    include APP_PATH . '/config/loader.php';

    $application = new \Phalcon\Mvc\Application($di);
    $application->useImplicitView(false);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
