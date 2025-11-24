<?php
require_once './app/models/UserModel.php';
require_once './app/views/AuthView.php';

class AuthController
{
    private $userModel;
    private $view;

    function __construct(){
        $this->userModel = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin($request){
        $this->view->showLogin("", $request->user);
    }

    public function doLogin($request){
        if (empty($_POST['user']) || empty($_POST['password'])) {
            return $this->view->showLogin("Faltan datos obligatorios", $request->user);
            }

        $user = $_POST['user'];
        $password = $_POST['password'];

        $userFromDB = $this->userModel->getByUser($user);

        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            $_SESSION['USER_ID'] = $userFromDB->id;
            $_SESSION['USER_NAME'] = $userFromDB->users;
            header("Location: " . BASE_URL . "home");
            return;
        } else {
            return $this->view->showLogin("Usuario o contraseña incorrecta", $request->user);
        }
    }

    public function logout($request){
        
        session_destroy();
        header("Location: " . BASE_URL . "home");
        return;
    }
}
