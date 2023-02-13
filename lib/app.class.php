<?php
class App
{
    protected static $router;
    public static $db;

    public function run($uri)
    {
        self::$router = new Router($uri);

        // if (Session::get('login') == null && Session::get('role') == null) {
        //     if (self::$router->getPathWithoutLanguage() != '/auth/login') {
        //         Session::setMessage("Та эхлээд нэвтэрнэ үү");
        //         Router::redirect("/auth/login");
        //     }
        // }
        // login хийсэн user эрхтэй хүн /dun эсвэл /user -т хандуулахгүй
        // if (Session::get('login') != null && Session::get('role') == 'user') {
        //     if (self::$router->getController() == 'dun' || self::$router->getController() == 'user') {
        //         Router::redirect("/pages");
        //     }
        // }
        // login хийсэн dun эрхтэй хүн /pages эсвэл /user -т хандуулахгүй
        // if (Session::get('login') != null && Session::get('role') == 'dun') {
        //     if (self::$router->getController() == 'pages' || self::$router->getController() == 'user') {
        //         Router::redirect("/dun");
        //     }
        // }

        self::$db = new Db(Config::get('db.host'), Config::get('db.database'), Config::get('db.user'), Config::get('db.password'));

        $controller = ucfirst(self::$router->getController()) . 'Controller';

        $action = self::$router->getMethodPrefix() . self::$router->getAction();

        $obj = new $controller();
        if (method_exists($controller, $action)) {
            echo $obj->$action();
        } else {
            echo '<h1>Not found!!!</h1>';
        }
    }

    public static function getRouter()
    {
        return self::$router;
    }
}