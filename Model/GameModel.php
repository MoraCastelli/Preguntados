<?php

class GameModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    //falta agregar q no se repitan preguntas y que te de una de tu misma dificultad

    public function obtenerPreguntaYRespuestas()
    {
        $queryPregunta = 'SELECT id, pregunta, categoría FROM pregunta ORDER BY RAND() LIMIT 1';
        $preguntas = $this->database->query($queryPregunta);

        $pregunta = $preguntas[0];
        $preguntaId = (int) $pregunta['id'];

        $queryRespuestas = "SELECT respuesta, es_la_correcta,id FROM respuesta WHERE pregunta = $preguntaId";
        $respuestas = $this->database->query($queryRespuestas);

        shuffle($respuestas);

        $resultado = [
            'pregunta_id' => $preguntaId,
            'pregunta' => $pregunta['pregunta'],
            'respuestas' => $respuestas,
            'categoria' => $pregunta['categoría']
        ];

        return $resultado;
    }


    public function crearPartida($idUsuario)
    {
        try {
            $queryInsertPartida = "INSERT INTO partida (puntaje, jugador) VALUES (0, '$idUsuario')";
            $this->database->execute($queryInsertPartida);
            $partidaId = $this->database->getLastInsertId();
            return $partidaId;
        } catch (Exception $e) {
            echo "Error al crear la partida: " . $e->getMessage();
            return null;
        }
    }

    public function guardarRespuestaEnPartida($idPartida, $preguntaId, $esCorrecta)
    {
        try {
            $queryInsertPartidaPregunta = "INSERT INTO partida_pregunta (partida, pregunta, se_respondio_bien) VALUES ('$idPartida', '$preguntaId', '$esCorrecta')";
            $this->database->execute($queryInsertPartidaPregunta);
        } catch (Exception $e) {
            echo "Error al guardar la respuesta: " . $e->getMessage();
        }
    }


    public function actualizarPuntajeFinal($idPartida, $puntajeFinal)
    {
        try {
            $queryUpdatePartida = "UPDATE partida SET puntaje = '$puntajeFinal' WHERE id = '$idPartida'";
            $this->database->execute($queryUpdatePartida);
        } catch (Exception $e) {
            echo "Error al actualizar el puntaje final: " . $e->getMessage();
        }
    }

    public function esRespuestaCorrecta($preguntaId, $respuestaId)
    {
        $query = "SELECT es_la_correcta FROM respuesta WHERE id = '$respuestaId' AND pregunta = '$preguntaId'";
        $result = $this->database->execute($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (bool) $row['es_la_correcta'];
        } else {
            return false;
        }
    }
    public function obtenerEstiloCategoria($categoria) {
        $categoriaEstilos = [
            'Ciencia' => 'w3-green',
            'Historia' => 'w3-yellow',
            'Entretenimiento' => 'w3-blue',
            'Geografía' => 'w3-light-blue',
            'Arte' => 'w3-red',
            'Deporte' => 'w3-grey'
        ];

        return $categoriaEstilos[$categoria] ?? 'w3-light-grey';
    }
}