<?php
session_start();

spl_autoload_register(function ($class_name) {
    $class_name = strtolower($class_name);

    $lib_path = ROOT . DS . 'lib' . DS . $class_name . '.class.php';
    $model_path = ROOT . DS . 'models' . DS . $class_name . '.php';
    $controller_path = ROOT . DS . 'controllers' . DS . str_replace('controller', '.controller', $class_name) . '.php';

    if (file_exists($lib_path)) {
        require $lib_path;
    } elseif (file_exists($model_path)) {
        require $model_path;
    } elseif (file_exists($controller_path)) {
        require $controller_path;
    } else {
        die($class_name . ' классыг autoload хийж чадсангүй!');
    }
});

require_once ROOT . DS . 'config' . DS . 'config.php';
