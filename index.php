<?php

// setup the autoloading
require_once './vendor/autoload.php';

// setup Propel
require_once './generated-reversed-database/generated-conf/config.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('./var/log/propel.log', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);

$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session'] = &$_SESSION;
$request['env'] = &$_SERVER;
//$response = $controller->$action_name($request);

var_dump($request);


/*
if (!empty($response['redirect_to'])) {
    header('Location: ' . $response['redirect_to']);
} else if (!empty($response['view'])) {

    $loader = new Twig_Loader_Filesystem('../src/WebSite/View');
    $twig = new Twig_Environment($loader);
    $twigVariables = $response[$page];
    $twigRoutes = $response['view'];
    echo $twig->render($twigRoutes, array($page => $twigVariables));

} else {
    throw new Exception('your action "'.$page.'" do not return a correct response array, should have "view" or "redirect_to"');
}