<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('ignore_repeated_errors', 0);

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$controllerName = $parts[1];
$actionName = $parts[2];


$controllerFileName = ucfirst($controllerName);

include "../App/Controller/$controllerFileName.php";

$controllerObj = new $controllerFileName();
$actionFuncName = $actionName . "Action";

if (!method_exists($controllerObj, $actionFuncName)) {
    echo "not found";
}

$tpl = "../App/Templates/" . $controllerFileName . "/" . $actionName . ".phtml";

include "../Base/View.php";
$view = new View();
$controllerObj->view = $view;

$controllerObj->$actionFuncName();
$view->render($tpl);
var_dump($tpl);