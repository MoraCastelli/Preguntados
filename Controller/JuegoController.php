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
        $this->filtroAntiF5();
        $data = $this->obtenerDataParaPartida();
        $this->guardarPartidaSiTermino($data);

        $this->presenter->render("View/lobby.mustache", $data);
    }

    public function verificarRespuesta()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $respuestaId = $_POST['respuesta_id'];
            $esCorrecta = $this->model->esRespuestaCorrecta($_POST['pregunta_id'], $respuestaId);

            $_SESSION['preguntas_respuestas'][] = [
                'pregunta_id' => $_POST['pregunta_id'],
                'se_respondio_bien' => $esCorrecta
            ];


            if ($esCorrecta) {
                $this->continuaJugando();
            } else {
                $this->gameOver();
                exit;
            }
        }
    }

    public function iniciarPartida()
    {
        // Limpiar todas las variables de sesión relacionadas con el juego
        unset($_SESSION['pagina_cargada']);
        unset($_SESSION['puntaje']);
        unset($_SESSION['puntaje_final']);
        unset($_SESSION['preguntas_respuestas']);
        header("Location: index.php?controller=Juego&action=get");
        exit();
    }

    private function checkLoggedIn()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
            exit();
        }
    }

    private function gameOver()
    {
        $puntaje = $_SESSION['puntaje'] ?? 0;
        $_SESSION['puntaje_final'] = $puntaje;
        $_SESSION['puntaje'] = 0;
        unset($_SESSION['pagina_cargada']);
        header("Location: index.php?controller=Juego&action=get&finalizado=true");
        exit;
    }

    private function continuaJugando()
    {
        $_SESSION['puntaje'] = isset($_SESSION['puntaje']) ? $_SESSION['puntaje'] + 1 : 1;
        unset($_SESSION['pagina_cargada']);
        header('Location: index.php?controller=Juego&action=get');
        exit;
    }

    private function filtroAntiF5()
    {
        if (isset($_SESSION['pagina_cargada']) && !isset($_GET['finalizado'])) {
            $this->gameOver();
            exit;
        }
    }

    private function obtenerDataParaPartida(): array
    {
        $_SESSION['pagina_cargada'] = true;
        $nombreUsuario = $_SESSION['usuario'];
        $preguntaData = $this->model->obtenerPreguntaYRespuestas();
        $pregunta = $preguntaData['pregunta'];
        $preguntaId = $preguntaData['pregunta_id'];
        $respuestas = $preguntaData['respuestas'];
        $categoria = $preguntaData['categoria'];
        $puntaje = $_SESSION['puntaje'] ?? 0;
        $finalizado = isset($_GET['finalizado']) && $_GET['finalizado'] == 'true';
        $puntajeFinal = $_SESSION['puntaje_final'] ?? null;



        $data = [
            'nombreUsuario' => $nombreUsuario,
            'pregunta' => $pregunta,
            'pregunta_id' => $preguntaId,
            'respuestas' => $respuestas,
            'categoria' => $categoria,
            'puntaje' => $puntaje,
            'finalizado' => $finalizado,
            'puntajeFinal' => $finalizado ? $puntajeFinal : null
        ];
        return $data;
    }

    public function guardarPartidaSiTermino(array $data)
    {
        if ($data['finalizado']) {
            $this->guardarPartida($data['puntajeFinal']);

        }
    }

    private function guardarPartida($puntajeFinal)
    {
        if (isset($_SESSION['preguntas_respuestas'])) {
            $preguntasRespuestas = $_SESSION['preguntas_respuestas'];
            $idUsuario = $_SESSION['id_usuario'];
            $this->model->guardarPartida($idUsuario, $puntajeFinal, $preguntasRespuestas);
        }
    }
}