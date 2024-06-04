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


    public function guardarPartida($idUsuario, $puntajeFinal, $preguntasRespuestas)
    {
        try {

            $queryInsertPartida = "INSERT INTO partida (puntaje, jugador) VALUES ('$puntajeFinal', '$idUsuario')";
            $this->database->execute($queryInsertPartida);


            $partidaId = $this->database->getLastInsertId();


            foreach ($preguntasRespuestas as $preguntaRespuesta) {
                $preguntaId = $preguntaRespuesta['pregunta_id'];
                $seRespondioBien = $preguntaRespuesta['se_respondio_bien'];

                $queryInsertPartidaPregunta = "INSERT INTO partida_pregunta (partida, pregunta, se_respondio_bien) VALUES ('$partidaId', '$preguntaId', '$seRespondioBien')";
                $this->database->execute($queryInsertPartidaPregunta);
            }
        } catch (Exception $e) {

            echo "Error al guardar la partida: " . $e->getMessage();
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