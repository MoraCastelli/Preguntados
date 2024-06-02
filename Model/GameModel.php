<?php



class GameModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }


public function obtenerPreguntaYRespuestas()
{
    //falta agregar q no se repitan preguntas y que te de una de tu misma dificultad
    $queryPregunta = 'SELECT id, pregunta, categoría FROM pregunta ORDER BY RAND() LIMIT 1';
    $preguntas = $this->database->query($queryPregunta);

    $pregunta = $preguntas[0];
    $preguntaId = (int) $pregunta['id'];


    $queryRespuestas = "SELECT respuesta, es_la_correcta FROM respuesta WHERE pregunta = $preguntaId";
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


    public function guardarPartida($idUsuario, $puntajeFinal,$preguntasRespuestas)
    {



        try {
            // Insertar información de la partida en la tabla 'partida'
            $queryInsertPartida = "INSERT INTO partida (puntaje, jugador) VALUES ('$puntajeFinal', '$idUsuario')";
            $this->database->execute($queryInsertPartida);

            // Obtener el ID de la partida recién insertada
            $partidaId = $this->database->getLastInsertId();

            // Insertar información de las preguntas respondidas en la tabla 'partida_pregunta'
            foreach ($preguntasRespuestas as $preguntaRespuesta) {
                $preguntaId = $preguntaRespuesta['pregunta_id'];
                $seRespondioBien = $preguntaRespuesta['se_respondio_bien'];

                $queryInsertPartidaPregunta = "INSERT INTO partida_pregunta (partida, pregunta, se_respondio_bien) VALUES ('$partidaId', '$preguntaId', '$seRespondioBien')";
                $this->database->execute($queryInsertPartidaPregunta);
            }
        } catch (Exception $e) {
            // Manejar el error como desees
            echo "Error al guardar la partida: " . $e->getMessage();
        }





}
}