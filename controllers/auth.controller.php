<?php
class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Users();
    }

    public function logout()
    {
        session_unset();
        Session::destroy();
        Router::redirect("/auth/login");
    }

    public function login()
    {

        if ($_POST && isset($_POST['login'])) {

            $user = $this->model->getByLogin($_POST['login']);


            // Хэрэглэгч олдсон эсэх
            if (sizeof($user) > 0) {

                $userPassword = $user[0]['password'];
                $userTypedPassword = $_POST['password'];
                if ($userPassword == md5(Config::get("salt") . $userTypedPassword)) {

                    Session::set('login', $_POST['login']);
                    Session::set('role', $user[0]['role']);
                    Session::set('user_id', $user[0]['id']);

                    if ($user[0]['role'] == 'user') {
                        Router::redirect("/pages");
                    } elseif ($user[0]['role'] == 'dun') {
                        Router::redirect("/dun");
                    } elseif ($user[0]['role'] == 'admin') {
                        Router::redirect("/pages");
                    }
                } else {
                    Session::setMessage("Нууц нэр эсвэл нууц үг буруу");
                }
            } else {
                Session::setMessage("Нууц нэр эсвэл нууц үг буруу!");
            }
        }

        return (new View(['site_title' => 'Нэвтрэх'], 'auth' . DS . 'login.html'))->render();
    }
}
