<?php

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/vendor/autoload.php';


if ($_GET) {
    $class = NAMESPACE_CONTROLLER . $_GET['class'];
    if (class_exists($class)) {
        $page = new $class;
        $page->show();
    }
} else {
    $class = NAMESPACE_CONTROLLER . 'HomeController';
    if (class_exists($class)) {
        $home = new $class;
    }
}