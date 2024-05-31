<?php

class JuegoController
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


        $nombreUsuario = isset($_SESSION['nombre_usuario']);
        $preguntaData = $this->model->obtenerPreguntaYRespuestas();
        $pregunta = $preguntaData['pregunta'];
        $respuestas = $preguntaData['respuestas'];
        $categoria = $preguntaData['categoria'];
        $puntaje = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] : 0;

        // Datos a pasar a la vista
        $data = [
            'nombreUsuario' => $nombreUsuario,
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'categoria' => $categoria,
            'puntaje' => $puntaje
        ];


        $this->presenter->render("View/lobby.mustache", $data);
    }


    public function verificarRespuesta() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $esCorrecta = $_POST['esCorrecta'] === 'true';
        if ($esCorrecta) {
            $_SESSION['puntaje'] = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] + 1 : 1;
            header('Location: index.php?controller=Juego&action=get');
            exit;
        } else {

            header('Location: index.php');
            exit;
        }
    }
}
}
