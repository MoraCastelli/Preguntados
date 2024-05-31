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
        $finalizado = isset($_GET['finalizado']) ? $_GET['finalizado'] == 'true' : false;
        

        // Datos a pasar a la vista
        $data = [
            'nombreUsuario' => $nombreUsuario,
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'categoria' => $categoria,
            'puntaje' => $puntaje,
            'finalizado' => $finalizado,
            'puntajeFinal' => $finalizado ? $puntaje : null
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

            $puntaje = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] : 0;
            // Reiniciar el puntaje

            // Pasar el puntaje actual en la URL al redirigir al usuario
            header("Location: index.php?controller=Juego&action=get&finalizado=true&puntaje={$puntaje}");
            exit;
        }
    }
}
}
