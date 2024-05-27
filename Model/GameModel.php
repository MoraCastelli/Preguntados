<?php



class GameModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
}