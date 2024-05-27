<?php

class RegistroController
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
        $this->presenter->render("src/view/register_form.mustache");
    }

    public function insertar()
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $ano_de_nacimiento = $_POST['ano_de_nacimiento'];
        $sexo = $_POST['sexo'];
        $mail = $_POST['mail'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $nombre_de_usuario = $_POST['nombre_de_usuario'];
        $foto_de_perfil = $_POST['foto_de_perfil'];

        // if (isset($_FILES['fotoPokemon'])) {
        //     $archivo_nombre = $_FILES['fotoPokemon']['name'];
        //     $archivo_temporal = $_FILES['fotoPokemon']['tmp_name'];
        //     $archivo_tamaño = $_FILES['fotoPokemon']['size'];
        //     $archivo_error = $_FILES['fotoPokemon']['error'];


        //     $ruta_destino = $directorio_destino . $archivo_nombre;
        //     move_uploaded_file($archivo_temporal, $ruta_destino);
        // } else {
        //     // Si no se proporciona una nueva imagen, conserva la imagen existente
        //     $ruta_destino = $directorio_destino . $_FILES['fotoPokemon']['name'];
        // }

        if ($contrasena == $confirmar_contrasena) {
            $this->model->registrarUsuario($nombre, $apellido, $ano_de_nacimiento, $sexo, $mail, $contrasena, $nombre_de_usuario, $foto_de_perfil);
        }
    }

}