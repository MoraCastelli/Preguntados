<?php



class GameModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }


public function obtenerPreguntaYRespuestas()
{// Obtener una pregunta al azar
    $queryPregunta = 'SELECT id, pregunta, categoría FROM pregunta ORDER BY RAND() LIMIT 1';
    $preguntas = $this->database->query($queryPregunta);



    $pregunta = $preguntas[0];
    $preguntaId = (int) $pregunta['id'];

    // Obtener las respuestas de la pregunta seleccionada
    $queryRespuestas = "SELECT respuesta, es_la_correcta FROM respuesta WHERE pregunta = $preguntaId";
    $respuestas = $this->database->query($queryRespuestas);



    // Mezclar las respuestas
    shuffle($respuestas);

    // Construir el resultado final
    $resultado = [
        'pregunta' => $pregunta['pregunta'],
        'respuestas' => $respuestas,
        'categoria' => $pregunta['categoría']
    ];

    return $resultado;
}







}