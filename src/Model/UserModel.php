<?php

namespace Model;

class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function registrarUsuario(){
        return $this->database->query("query para insertar en la bd");
    }
}