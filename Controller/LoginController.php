<?php


class LoginController
{
    private $presenter;
    private $model;

    public function __construct($Model, $Presenter)
    {
        $this->model = $Model;
        $this->presenter = $Presenter;
    }


    public function get()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["usuario"]) && isset($_POST["password"])) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];

            // Realizar la validación del usuario y contraseña
            if ($this->model->LogInconsulta($usuario, $password)) {

                unset($_SESSION["error_login"]);
            } else {
                $_SESSION["error_login"] = "Usuario o contraseña incorrectos. presta atencion mora";
            }
        } else {
            // Si no se enviaron credenciales, establecer el mensaje de error
            $_SESSION["error_login"] = "Por favor, ingresa tus credenciales.";
        }

        header("Location:index.php?controller=Home&action=get");
        exit();
    }

    public function logout()
    {

        session_destroy();
        session_unset();
        header("Location:index.php?controller=Home&action=get");

        exit();
    }


    public function activar(){
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];

            // Verificar el código de activación
            if ($this->model->emailVerificado($codigo)) {
                header('Location:index.php?controller=home&action=get');
            } else {
                // Redireccionar o mostrar mensaje de error
            }
        } else {
            // Redireccionar o mostrar mensaje de error
        }
    }


}