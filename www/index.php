<?php
const DS = DIRECTORY_SEPARATOR;
define('ROOT', dirname(dirname(__FILE__)));
const VIEWS_PATH = ROOT . DS . 'views' . DS;
require_once ROOT . DS . 'lib' . DS . 'init.php';

$app = new App();
$app->run($_SERVER['REQUEST_URI']);


function dd($data)
{
    echo "<pre>";
    print_r($data);
    exit;
}

function isSuccessLogin(){
    if (Session::get('login') == null || Session::get('role') == null || Session::get('user_id') == null) {
        return false;
    }

    return true;
}