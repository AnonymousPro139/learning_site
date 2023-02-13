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
        Router::redirect("/");
    }

    public function login()
    {
        if ($_POST && $_POST['phone'] != "") {

            $user = $this->model->getByLogin($_POST['phone']);

            // Хэрэглэгч олдсон эсэх
            if (sizeof($user) > 0) {
                $userPassword = $user[0]['password'];
                $userTypedPassword = $_POST['password'];

                if ($userPassword == md5(Config::get("salt") . $userTypedPassword)) {

                    Session::set('phone', $_POST['phone']);
                    Session::set('role', $user[0]['role']);
                    Session::set('user_id', $user[0]['id']);

                    if ($user[0]['role'] == 'user') {
                        Router::redirect("/course#courses");
                    } elseif ($user[0]['role'] == 'teacher') {
                        Router::redirect("/teacher");
                    } elseif ($user[0]['role'] == 'admin') {
                        Router::redirect("/admin");
                    }
                } else {
                    Session::setMessage("Нэр эсвэл нууц үг буруу");
                }
            } else {
                Session::setMessage("Нэр эсвэл нууц үг буруу!");
            }
        }

        return (new View(['site_title' => 'Нэвтрэх'], 'auth' . DS . 'login.html'))->render();
    }

    public function signup()
    {
        if ($_POST && $_POST['phone'] != "") {

            $user = $this->model->getByLogin($_POST['phone']);

            // Хэрэглэгч олдсон эсэх
            if (sizeof($user) > 0) {
                Session::setMessage("Бүртгэлтэй утасны дугаар байна.");
            } else {
                $userTypedPassword = $_POST['password'];
                $userRepeatPassword = $_POST['repassword'];
                
                if ($userTypedPassword == $userRepeatPassword ) {
                    $user = $this->model->add($_POST);

                    if($user == 1){
                        Session::setMessage("Бүртгэл амжилттай");
                        Router::redirect("/auth/login#login");
                    } else{
                        Session::setMessage("Бүртгэл амжилтгүй, түр хүлээгээд дахин оролдоно уу");
                    }
                } else {
                    Session::setMessage("Нууц үгнүүд хоорондоо таарсангүй!");
                }
            }
        }

        return (new View(['site_title' => 'Бүртгүүлэх'], 'auth' . DS . 'signup.html'))->render();
    }
}