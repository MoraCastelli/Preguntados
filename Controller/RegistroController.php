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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $ano_de_nacimiento = $_POST['ano_de_nacimiento'] ?? null;
            $sexo = $_POST['sexo'] ?? null;
            $mail = $_POST['mail'] ?? null;
            $contrasena = $_POST['contrasena'] ?? null;
            $nombre_de_usuario = $_POST['nombre_de_usuario'] ?? null;
            $foto_de_perfil = $_FILES['foto_de_perfil']['name'] ?? null;


            if (!empty($foto_de_perfil)) {
                move_uploaded_file($_FILES['foto_de_perfil']['tmp_name'], 'public/img' . $foto_de_perfil);
            }


            $this->model->registrarUsuario($nombre, $apellido, $ano_de_nacimiento, $sexo, $mail, $contrasena, $nombre_de_usuario, $foto_de_perfil);
        }

        header('Location:index.php?controller=home&action=get');
        exit();
    }
}


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