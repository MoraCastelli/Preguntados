<?php

class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

// ta rotisimo
    public function registrarUsuario($nombre,  $apellido, $ano_de_nacimiento ,$sexo, $mail , $contrasena, $nombre_de_usuario, $foto_de_perfil){
    //     return $this->database->execute("INSERT INTO usuario (nombre, apellido, ano_de_nacimiento, sexo, mail, contrasena, nombre_de_usuario, foto_de_perfil)
    //     VALUES (". $nombre. ", ". $apellido. ", ". $ano_de_nacimiento . ", ". $sexo .", " . $mail . ", " . $contrasena .", ". $nombre_de_usuario . ", " . $foto_de_perfil. ")");
    // 
    header ('location : index.php?controller=home&method=get');
}
}