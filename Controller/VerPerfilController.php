<?php
class VerPerfilController
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
        $perfil = $this->model->verPerfil();
        if (!empty($perfil)) {
            $this->presenter->render('view/Perfil.mustache', $perfil[0]);

        } else {
            echo "upsi, algo falla";
        }
    }
}