<?php



class LoginModel
{


    private $Database;

    public function __construct($Database)
    {
        $this->Database = $Database;
    }

    public function RegistrarUsuario($usuario){


        $this->Database->query($usuario);



    }

public function LogInconsulta($usuario, $password)
{

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = 'admin' AND password = 'admin'";
    $result = $this->Database->query($sql);
    //return $result;
    return false;
}


}