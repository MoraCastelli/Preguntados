<?php


class   UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

// ta rotisimo
    public function registrarUsuario($nombre, $apellido, $ano_de_nacimiento, $sexo, $mail, $contrasena, $nombre_de_usuario, $foto_de_perfil)
    {
        $sql = "INSERT INTO usuario (nombre, apellido, ano_de_nacimiento, sexo, mail, contrasena, nombre_de_usuario, foto_de_perfil) 
            VALUES ('$nombre', '$apellido', $ano_de_nacimiento, '$sexo', '$mail', '$contrasena', '$nombre_de_usuario', '$foto_de_perfil')";


        $this->database->execute($sql);



    }




        public function LogInconsulta($usuario, $password)
    {

        $sql = "SELECT * FROM usuario WHERE nombre_de_usuario = '$usuario' AND contrasena= '$password'";

        $result =  $this->database->execute($sql);

        // Si se encuentra un resultado, es válido
        return $result->num_rows == 1 && $this->emailVerificado();



    }

    private function emailVerificado()
    {
     //falta agregar lo del mail
        return True;

    }


}