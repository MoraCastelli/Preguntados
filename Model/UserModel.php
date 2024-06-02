<?php
class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function registrarJugador($nombre, $apellido, $ano_de_nacimiento, $sexo, $mail, $contrasena, $nombre_de_usuario, $foto_de_perfil)
{
    // Inserta en usuario
    $sql = "INSERT INTO usuario (contrasena, nombre_de_usuario) 
            VALUES ('$contrasena', '$nombre_de_usuario')";
    $this->database->execute($sql);

    // Obtén el ID del usuario recién insertado
    $idJugador = $this->database->getLastInsertId();

    // Inserta en jugador
    $sqlJugador = "INSERT INTO jugador (id, nombre, apellido, ano_de_nacimiento, sexo, mail, foto_de_perfil, pais, ciudad, cuenta_verificada, hash_activacion)
                   VALUES ('$idJugador', '$nombre', '$apellido', '$ano_de_nacimiento', '$sexo', '$mail', '$foto_de_perfil', '...', '..', FALSE, '..')";
    $this->database->execute($sqlJugador);
}

    public function LogInconsulta($usuario, $password)
    {

        $sql = "SELECT * FROM usuario WHERE nombre_de_usuario = '$usuario' AND contrasena= '$password'";

        $result = $this->database->execute($sql);

        if ($result->num_rows == 1 && $this->emailVerificado()) {
            $usuario = $result->fetch_assoc();

            $_SESSION["usuario"] = $usuario["nombre_de_usuario"];
            $_SESSION['id_usuario'] = $usuario['id_usuario'];

            return true;
        }
        else {
            return false;
    }
    }
    private function emailVerificado()
    {
        //falta agregar lo del mail
        return True;
    }

    public function verPerfil()
    {
        $usuario = $_SESSION["usuario"];
        $sql = "SELECT * FROM usuario WHERE nombre_de_usuario = '$usuario'";
        $resultado = $this->database->query($sql);
        $_SESSION['perfil'] = $resultado;
        return $resultado;
    }
}