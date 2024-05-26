<?php

class RegistroController {
    private $presenter;
    private $model;

    public function __construct($Model, $Presenter) {
        $this->model = $Model;
        $this->presenter = $Presenter;
    }

    public function get() {

        $this->presenter->render("view/Registro.mustache");
    }

}