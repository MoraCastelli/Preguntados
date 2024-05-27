<?php

include_once ("src/Controller/RegistroController.php");
include_once ("src/Controller/HomeController.php");

include_once ("helper/Router.php");
include_once ("helper/DataBase.php");
include_once ("helper/MustachePresenter.php");
include_once ("vendor/mustache/src/Mustache/Autoloader.php");

include_once ('src/Model/UserModel.php');

class Configuration
{

    //controller
    public static function getRegistroController()
    {
        return new RegistroController(self::getUserModel(), self::getPresenter());
    }

    public static function getHomeController(){
        return new HomeController(self::getUserModel(), self::getPresenter());
    }

    //model
    public static function getUserModel()
    {
        return new UserModel(self::Database());
    }

    //Helper
    public static function getRouter()
    {
        return new Router(
            "getRegistroController", "get");
    }

    private static function getPresenter()
    {

        return new MustachePresenter("src/view/template");
    }
    private static function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }

    public static function Database()
    {
        $config = self::getConfig();
        return new Database($config["servername"], $config["username"], $config["database"], $config["password"]);
    }

}