<?php

// setup the autoloading
require_once __DIR__.'/vendor/autoload.php';

// setup Propel
require_once __DIR__.'/generated-reversed-database/generated-conf/config.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Controller\RoutesController;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler(__DIR__.'/var/log/propel.log', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);

session_start();

$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session'] = &$_SESSION;
$request['env'] = &$_SERVER;
$request['page'] = explode('/',$request['env']['REQUEST_URI']);
$request['requested_page'] = "";
for ($i = 1; $i < sizeof($request['page']); $i++) {
    $request['requested_page'] .= "/".$request['page'][$i];
}
$controller = new RoutesController();
var_dump($controller);
$response = $controller->getController($request['requested_page']);
if (!empty($response['controller']['redirect_to'])) {
    header('Location: ' . $response['controller']['redirect_to']);
} else if (!empty($response['controller']['view'])) {
    $loader = new Twig_Loader_Filesystem(__DIR__.'/src/view');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));
    $twig->addExtension(new Twig_Extension_Debug());
    $twigVariables = $response['controller'][$response['index']];
    $twigRoutes = $response['controller']['view'];
    var_dump($request);
    if ($request['requested_page'] == '/'
        || $request['requested_page'] == "/user"
        || $request['requested_page'] == "/admin"
        || $request['requested_page'] == "/login"
        || $request['requested_page'] == "/inscription"
        || $request['requested_page'] == "/home") {
        include_once __DIR__.'/src/view/header.twig';
    }
    echo $twig->render($twigRoutes, array($response['index'] => $twigVariables));
} else {
    throw new Exception('your action "'.$request['requested_page'].
        '" do not return a correct response array, should have "view" or "redirect_to"');
}