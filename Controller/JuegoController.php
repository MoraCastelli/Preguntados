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
        $this->guardarPuntajeSiTermino($data);

        $this->presenter->render("View/lobby.mustache", $data);
    }

    public function verificarRespuesta()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $respuestaId = $_POST['respuesta_id'];
            $preguntaId=$_POST['pregunta_id'];
            $idUsuario = $_SESSION['id_usuario'];
            $idPartida = $_SESSION['id_partida'];

            $esCorrecta = $this->model->esRespuestaCorrecta($preguntaId, $respuestaId);


            $this->model->guardarRespuestaEnPartida($idPartida, $preguntaId, $esCorrecta);


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


        $idUsuario = $_SESSION['id_usuario'];
        $idPartida = $this->model->crearPartida($idUsuario);
        $_SESSION['id_partida'] = $idPartida;
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
        $idPartida = $_SESSION['id_partida'];
        $puntaje = $_SESSION['puntaje'] ?? 0;
        $_SESSION['puntaje_final'] = $puntaje;
        $_SESSION['puntaje'] = 0;

        unset($_SESSION['pagina_cargada']);


        $this->model->actualizarPuntajeFinal($idPartida, $puntaje);
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
        $categoriaEstilo = $this->model->obtenerEstiloCategoria($categoria);
        $puntaje = $_SESSION['puntaje'] ?? 0;
        $finalizado = isset($_GET['finalizado']) && $_GET['finalizado'] == 'true';
        $puntajeFinal = $_SESSION['puntaje_final'] ?? null;



        $data = [
            'nombreUsuario' => $nombreUsuario,
            'pregunta' => $pregunta,
            'pregunta_id' => $preguntaId,
            'respuestas' => $respuestas,
            'categoria' => $categoria,
            'categoria_estilo'=> $categoriaEstilo,
            'puntaje' => $puntaje,
            'finalizado' => $finalizado,
            'puntajeFinal' => $finalizado ? $puntajeFinal : null
        ];
        return $data;
    }

    public function guardarPuntajeSiTermino(array $data)
    {
        if ($data['finalizado']) {
            $this->actualizarPuntajeFinal($data['puntajeFinal']);

        }
    }

    private function actualizarPuntajeFinal($puntajeFinal)
    {
            $idPartida = $_SESSION['id_partida'];

            $this->model->actualizarPuntajeFinal($idPartida, $puntajeFinal);
        }

}