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
    $preguntas = [
        [
            'pregunta' => '¿Cuál es la capital de Francia?',
            'respuestas' => [
                ['respuesta' => 'París', 'esCorrecta' => true],
                ['respuesta' => 'Londres', 'esCorrecta' => false],
                ['respuesta' => 'Roma', 'esCorrecta' => false],
                ['respuesta' => 'Berlín', 'esCorrecta' => false]
            ],
            'categoria' => 'Geografía'
        ],
        [
            'pregunta' => '¿Quién escribió "Cien años de soledad"?',
            'respuestas' => [
                ['respuesta' => 'Gabriel García Márquez', 'esCorrecta' => true],
                ['respuesta' => 'Mario Vargas Llosa', 'esCorrecta' => false],
                ['respuesta' => 'Julio Cortázar', 'esCorrecta' => false],
                ['respuesta' => 'Jorge Luis Borges', 'esCorrecta' => false]
            ],
            'categoria' => 'Literatura'
        ],
        [
            'pregunta' => '¿Cuál es el planeta más grande del sistema solar?',
            'respuestas' => [
                ['respuesta' => 'Júpiter', 'esCorrecta' => true],
                ['respuesta' => 'Saturno', 'esCorrecta' => false],
                ['respuesta' => 'Urano', 'esCorrecta' => false],
                ['respuesta' => 'Neptuno', 'esCorrecta' => false]
            ],
            'categoria' => 'Astronomía'
        ],
        [
            'pregunta' => '¿Cuál es el elemento químico con el símbolo "O"?',
            'respuestas' => [
                ['respuesta' => 'Oxígeno', 'esCorrecta' => true],
                ['respuesta' => 'Oro', 'esCorrecta' => false],
                ['respuesta' => 'Osmio', 'esCorrecta' => false],
                ['respuesta' => 'Oganesón', 'esCorrecta' => false]
            ],
            'categoria' => 'Química'
        ],
        [
            'pregunta' => '¿En qué año comenzó la Segunda Guerra Mundial?',
            'respuestas' => [
                ['respuesta' => '1939', 'esCorrecta' => true],
                ['respuesta' => '1914', 'esCorrecta' => false],
                ['respuesta' => '1941', 'esCorrecta' => false],
                ['respuesta' => '1945', 'esCorrecta' => false]
            ],
            'categoria' => 'Historia'
        ]
    ];

    // Retornar una pregunta aleatoria del array
    return $preguntas[array_rand($preguntas)];
}


}