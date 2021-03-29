
<?php

use Localize\Controller\InterfaceController;
use Localize\Helpers\Util;

require __DIR__ . '/../vendor/autoload.php';

$path = '/' . explode('/', $_SERVER['PATH_INFO'])[1];

$rotas = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($path, $rotas)){
    header('Location: /404', true, 302 );
}
$classControl = $rotas[$path];

$ignore_paths = [
    '/',
    '/confirmed',
    '/confirmation',
    '/forgot',
    '/404',
    '/error'
];

session_start();
if(!$classControl) {
    
}

if((!isset($_SESSION['id']) && !$_SESSION['erro']) && $path !== null){
    if(!Util::ignorePath($ignore_paths, $path)){
        header('Location: /', true, 302);
    }
}

/** @var InterfaceController $controller */
$controller =  new $classControl;
$controller->request();
