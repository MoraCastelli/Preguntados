<?php

include_once ("Controller/PaginaDeVisualizacionController.php");
include_once ("Controller/PokedexController.php");
include_once ("Controller/PaginaDeCreacionController.php");
include_once("Controller/LoginsController.php");


include_once ("Model/PokemonModel.php");
include_once ("Helper/Router.php");
include_once ("Helper/DataBase.php");
include_once ("Helper/MustachePresenter.php");
include_once ("vendor/mustache/src/Mustache/Autoloader.php");

class Configuration
{

    //controller




    //model
    public static function getUserModel(){
        return new UserModel(self::Database());
    }

    //Helper
    public static function getRouter(){
        return new Router();
    }

    private static function getPresenter()
    {

        return new MustachePresenter("view/template");
    }
    private static function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }

    public static function Database(){
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["database"], $config["password"]);
    }

}