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
        $puntajeFinal = isset($_SESSION['puntaje_final']) ? $_SESSION['puntaje_final'] : null;

        // Datos a pasar a la vista
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
        $esCorrecta = $_POST['esCorrecta'] === 'true';
        if ($esCorrecta) {
            $_SESSION['puntaje'] = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] + 1 : 1;
            header('Location: index.php?controller=Juego&action=get');
            exit;
        } else {

            $puntaje = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] : 0;
            $_SESSION['puntaje_final'] = $puntaje; // Guardar el puntaje final en la sesión
            $_SESSION['puntaje'] = 0; // Restablecer el puntaje normal a 0
            header("Location: index.php?controller=Juego&action=get&finalizado=true");
            exit;
        }
    }
}
}
