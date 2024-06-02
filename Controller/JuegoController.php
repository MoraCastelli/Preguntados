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

        $this->checkLoggedIn();
        $nombreUsuario =$_SESSION['usuario'];
        $preguntaData = $this->model->obtenerPreguntaYRespuestas();
        $pregunta = $preguntaData['pregunta'];
        $respuestas = $preguntaData['respuestas'];
        $categoria = $preguntaData['categoria'];
        $puntaje = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] : 0;
        $finalizado = isset($_GET['finalizado']) ? $_GET['finalizado'] == 'true' : false;
        $puntajeFinal = isset($_SESSION['puntaje_final']) ? $_SESSION['puntaje_final'] : null;


        $data = [
            'nombreUsuario' => $nombreUsuario,
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'categoria' => $categoria,
            'puntaje' => $puntaje,
            'finalizado' => $finalizado,
            'puntajeFinal' => $finalizado ? $puntajeFinal : null
        ];

        $this->presenter->render("View/lobby.mustache", $data);
    }

    public function verificarRespuesta() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $esCorrecta = $_POST['es_la_correcta'] === 'true';

        if ($esCorrecta) {
            $_SESSION['puntaje'] = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] + 1 : 1;
            header('Location: index.php?controller=Juego&action=get');
            exit;
        } else {
            $puntaje = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] : 0;
            $_SESSION['puntaje_final'] = $puntaje;
            $_SESSION['puntaje'] = 0;
            header("Location: index.php?controller=Juego&action=get&finalizado=true");
            exit;
        }
    }
}

    private function checkLoggedIn()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
            exit();
        }
    }





}
