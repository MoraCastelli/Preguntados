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
                $_SESSION["usuario"] = $usuario;
                unset($_SESSION["error_login"]);
            } else {
                $_SESSION["error_login"] = "Usuario o contraseña incorrectos. presta atencion mora";
            }
        } else {
            // Si no se enviaron credenciales, establecer el mensaje de error
            $_SESSION["error_login"] = "Por favor, ingresa tus credenciales.";
        }

        // Redirigir a la página principal del Pokedex
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





}