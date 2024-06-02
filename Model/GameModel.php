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

    // Mezclar las respuestas
    shuffle($respuestas);


    $resultado = [
        'pregunta' => $pregunta['pregunta'],
        'respuestas' => $respuestas,
        'categoria' => $pregunta['categoría']
    ];

    return $resultado;
}


    public function guardarPartida($usuario, $puntajeFinal, $preguntasRespuestas)
    {
    //falta completar para guardar partida

    }




}