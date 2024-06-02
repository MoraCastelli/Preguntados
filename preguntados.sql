USE preguntados;

CREATE TABLE usuario(
	id int auto_increment primary key,
    nombre_de_usuario varchar(50),
    contrasena varchar(50)
);

CREATE TABLE administrador(
	 id int,
	constraint primary key (id),
    foreign key (id) references usuario(id)
);

CREATE TABLE editor(
	id int,
	constraint primary key (id),
    foreign key (id) references usuario(id)
);

CREATE TABLE jugador(
	id int,
    nombre varchar(50),
    apellido varchar(50),
    ano_de_nacimiento year(4),
    sexo ENUM('Femenino', 'Masculino', 'Prefiero no cargarlo'),
    mail varchar(50),
    foto_de_perfil varchar(50),
    pais varchar(50),
    ciudad varchar(50),
    cuenta_verificada boolean,
    hash_activacion varchar(500),
	constraint primary key (id),
    foreign key (id) references usuario(id)
);

CREATE TABLE pregunta(
	id int auto_increment primary key,
    pregunta varchar(150),
    categoría ENUM('Geografía', 'Ciencia', 'Historia', 'Deporte', 'Arte', 'Entretenimiento')
);CREATE TABLE respuesta(
                            id int auto_increment primary key,
                            respuesta varchar(150),
                            es_la_correcta boolean,
                            pregunta int references pregunta(id)
  );

CREATE TABLE partida (
                         id int auto_increment primary key,
                         puntaje int,
                         jugador int references jugador(id)
);



CREATE TABLE partida_pregunta (
	partida int,
    pregunta int,
    se_respondio_bien boolean,
    constraint primary key (partida, pregunta),
    foreign key (partida) references partida(id),
    foreign key (pregunta) references pregunta(id)
);

INSERT INTO pregunta (pregunta, categoría) VALUES
                                               ('¿Cuál es la capital de Francia?', 'Geografía'),
                                               ('¿Quién formuló la teoría de la relatividad?', 'Ciencia'),
                                               ('¿En qué año comenzó la Segunda Guerra Mundial?', 'Historia'),
                                               ('¿Cuál es el deporte nacional de Japón?', 'Deporte'),
                                               ('¿Quién pintó la Mona Lisa?', 'Arte'),
                                               ('¿Cuál es el nombre del actor que interpreta a Iron Man en el MCU?', 'Entretenimiento'),
                                               ('¿Cuál es el río más largo del mundo?', 'Geografía'),
                                               ('¿Qué gas es esencial para la respiración humana?', 'Ciencia'),
                                               ('¿Quién fue el primer presidente de Estados Unidos?', 'Historia'),
                                               ('¿En qué deporte se utiliza una raqueta?', 'Deporte'),
                                               ('¿Quién es el autor de "El Quijote"?', 'Arte'),
                                               ('¿Cuál es la serie de televisión con más temporadas?', 'Entretenimiento'),
                                               ('¿Cuál es el país más grande del mundo?', 'Geografía'),
                                               ('¿Cuál es el símbolo químico del oro?', 'Ciencia'),
                                               ('¿En qué año llegó el hombre a la Luna?', 'Historia'),
                                               ('¿Qué deporte se juega con un bate y una pelota?', 'Deporte'),
                                               ('¿Quién pintó "La última cena"?', 'Arte'),
                                               ('¿Qué película ganó el Óscar a la mejor película en 1994?', 'Entretenimiento'),
                                               ('¿Cuál es el desierto más grande del mundo?', 'Geografía'),
                                               ('¿Cuál es el planeta más grande del sistema solar?', 'Ciencia'),
                                               ('¿Quién descubrió América?', 'Historia'),
                                               ('¿Cuántos jugadores hay en un equipo de fútbol?', 'Deporte'),
                                               ('¿Quién escribió "Romeo y Julieta"?', 'Arte'),
                                               ('¿Cuál es el nombre del mago protagonista en "Harry Potter"?', 'Entretenimiento'),
                                               ('¿Cuál es la montaña más alta del mundo?', 'Geografía'),
                                               ('¿Cuál es el elemento químico más abundante en el universo?', 'Ciencia'),
                                               ('¿En qué año terminó la Primera Guerra Mundial?', 'Historia'),
                                               ('¿Qué deporte se juega en el Wimbledon?', 'Deporte'),
                                               ('¿Quién pintó "La noche estrellada"?', 'Arte'),
                                               ('¿Cuál es la canción más famosa de Queen?', 'Entretenimiento'),
                                               ('¿Cuál es el océano más grande del mundo?', 'Geografía'),
                                               ('¿Quién desarrolló la teoría de la evolución?', 'Ciencia'),
                                               ('¿En qué año cayó el Muro de Berlín?', 'Historia'),
                                               ('¿Cuál es el país con la mayor cantidad de Copas del Mundo de fútbol?', 'Deporte'),
                                               ('¿Quién es el escultor de "El David"?', 'Arte'),
                                               ('¿Cuál es la película más taquillera de todos los tiempos?', 'Entretenimiento'),
                                               ('¿Cuál es el continente más grande?', 'Geografía'),
                                               ('¿Qué es H2O?', 'Ciencia'),
                                               ('¿Quién fue el emperador de Francia en 1804?', 'Historia'),
                                               ('¿Qué deporte se juega en la NBA?', 'Deporte'),
                                               ('¿Quién pintó "Guernica"?', 'Arte'),
                                               ('¿Cuál es el nombre del villano en "Los Vengadores"?', 'Entretenimiento'),
                                               ('¿Cuál es el río más largo de África?', 'Geografía'),
                                               ('¿Qué órgano bombea la sangre en el cuerpo humano?', 'Ciencia'),
                                               ('¿Quién fue el primer emperador romano?', 'Historia'),
                                               ('¿En qué deporte se utilizan las bicicletas?', 'Deporte'),
                                               ('¿Quién escribió "Cien años de soledad"?', 'Arte'),
                                               ('¿Cuál es la serie de televisión sobre un químico convertido en fabricante de drogas?', 'Entretenimiento');


INSERT INTO respuesta (respuesta, es_la_correcta, pregunta) VALUES
                                                                ('Paris', TRUE, 1),
                                                                ('Londres', FALSE, 1),
                                                                ('Madrid', FALSE, 1),
                                                                ('Roma', FALSE, 1),

                                                                ('Albert Einstein', TRUE, 2),
                                                                ('Isaac Newton', FALSE, 2),
                                                                ('Galileo Galilei', FALSE, 2),
                                                                ('Nikola Tesla', FALSE, 2),

                                                                ('1939', TRUE, 3),
                                                                ('1941', FALSE, 3),
                                                                ('1935', FALSE, 3),
                                                                ('1945', FALSE, 3),

                                                                ('Sumo', TRUE, 4),
                                                                ('Karate', FALSE, 4),
                                                                ('Judo', FALSE, 4),
                                                                ('Béisbol', FALSE, 4),

                                                                ('Leonardo da Vinci', TRUE, 5),
                                                                ('Vincent van Gogh', FALSE, 5),
                                                                ('Pablo Picasso', FALSE, 5),
                                                                ('Claude Monet', FALSE, 5),

                                                                ('Robert Downey Jr.', TRUE, 6),
                                                                ('Chris Evans', FALSE, 6),
                                                                ('Mark Ruffalo', FALSE, 6),
                                                                ('Chris Hemsworth', FALSE, 6),

                                                                ('Amazonas', TRUE, 7),
                                                                ('Nilo', FALSE, 7),
                                                                ('Misisipi', FALSE, 7),
                                                                ('Yangtsé', FALSE, 7),

                                                                ('Oxígeno', TRUE, 8),
                                                                ('Nitrógeno', FALSE, 8),
                                                                ('Hidrógeno', FALSE, 8),
                                                                ('Dióxido de Carbono', FALSE, 8),

                                                                ('George Washington', TRUE, 9),
                                                                ('Thomas Jefferson', FALSE, 9),
                                                                ('Abraham Lincoln', FALSE, 9),
                                                                ('John Adams', FALSE, 9),

                                                                ('Tenis', TRUE, 10),
                                                                ('Fútbol', FALSE, 10),
                                                                ('Baloncesto', FALSE, 10),
                                                                ('Natación', FALSE, 10),

                                                                ('Miguel de Cervantes', TRUE, 11),
                                                                ('Gabriel García Márquez', FALSE, 11),
                                                                ('Julio Cortázar', FALSE, 11),
                                                                ('Mario Vargas Llosa', FALSE, 11),

                                                                ('Los Simpson', TRUE, 12),
                                                                ('Friends', FALSE, 12),
                                                                ('Breaking Bad', FALSE, 12),
                                                                ('Game of Thrones', FALSE, 12),

                                                                ('Rusia', TRUE, 13),
                                                                ('Canadá', FALSE, 13),
                                                                ('China', FALSE, 13),
                                                                ('Estados Unidos', FALSE, 13),

                                                                ('Au', TRUE, 14),
                                                                ('Ag', FALSE, 14),
                                                                ('Fe', FALSE, 14),
                                                                ('Hg', FALSE, 14),

                                                                ('1969', TRUE, 15),
                                                                ('1965', FALSE, 15),
                                                                ('1970', FALSE, 15),
                                                                ('1975', FALSE, 15),

                                                                ('Béisbol', TRUE, 16),
                                                                ('Fútbol', FALSE, 16),
                                                                ('Baloncesto', FALSE, 16),
                                                                ('Críquet', FALSE, 16),

                                                                ('Leonardo da Vinci', TRUE, 17),
                                                                ('Michelangelo', FALSE, 17),
                                                                ('Raphael', FALSE, 17),
                                                                ('Donatello', FALSE, 17),

                                                                ('Forrest Gump', TRUE, 18),
                                                                ('Pulp Fiction', FALSE, 18),
                                                                ('The Shawshank Redemption', FALSE, 18),
                                                                ('The Lion King', FALSE, 18),

                                                                ('Sahara', TRUE, 19),
                                                                ('Gobi', FALSE, 19),
                                                                ('Kalahari', FALSE, 19),
                                                                ('Patagonia', FALSE, 19),

                                                                ('Júpiter', TRUE, 20),
                                                                ('Saturno', FALSE, 20),
                                                                ('Marte', FALSE, 20),
                                                                ('Neptuno', FALSE, 20),

                                                                ('Cristóbal Colón', TRUE, 21),
                                                                ('Américo Vespucio', FALSE, 21),
                                                                ('Fernando de Magallanes', FALSE, 21),
                                                                ('Hernán Cortés', FALSE, 21),

                                                                ('11', TRUE, 22),
                                                                ('9', FALSE, 22),
                                                                ('10', FALSE, 22),
                                                                ('12', FALSE, 22),

                                                                ('William Shakespeare', TRUE, 23),
                                                                ('Charles Dickens', FALSE, 23),
                                                                ('Jane Austen', FALSE, 23),
                                                                ('Mark Twain', FALSE, 23),

                                                                ('Harry Potter', TRUE, 24),
                                                                ('Hermione Granger', FALSE, 24),
                                                                ('Ron Weasley', FALSE, 24),
                                                                ('Albus Dumbledore', FALSE, 24),

                                                                ('Everest', TRUE, 25),
                                                                ('K2', FALSE, 25),
                                                                ('Kangchenjunga', FALSE, 25),
                                                                ('Lhotse', FALSE, 25),

                                                                ('Hidrógeno', TRUE, 26),
                                                                ('Oxígeno', FALSE, 26),
                                                                ('Carbono', FALSE, 26),
                                                                ('Helio', FALSE, 26),

                                                                ('1918', TRUE, 27),
                                                                ('1917', FALSE, 27),
                                                                ('1916', FALSE, 27),
                                                                ('1919', FALSE, 27),

                                                                ('Tenis', TRUE, 28),
                                                                ('Fútbol', FALSE, 28),
                                                                ('Baloncesto', FALSE, 28),
                                                                ('Golf', FALSE, 28),

                                                                ('Vincent van Gogh', TRUE, 29),
                                                                ('Pablo Picasso', FALSE, 29),
                                                                ('Claude Monet', FALSE, 29),
                                                                ('Salvador Dalí', FALSE, 29),

                                                                ('Bohemian Rhapsody', TRUE, 30),
                                                                ('We Will Rock You', FALSE, 30),
                                                                ('We Are the Champions', FALSE, 30),
                                                                ('Another One Bites the Dust', FALSE, 30),

                                                                ('Pacífico', TRUE, 31),
                                                                ('Atlántico', FALSE, 31),
                                                                ('Índico', FALSE, 31),
                                                                ('Ártico', FALSE, 31),

                                                                ('Charles Darwin', TRUE, 32),
                                                                ('Isaac Newton', FALSE, 32),
                                                                ('Albert Einstein', FALSE, 32),
                                                                ('Galileo Galilei', FALSE, 32),

                                                                ('1989', TRUE, 33),
                                                                ('1987', FALSE, 33),
                                                                ('1990', FALSE, 33),
                                                                ('1991', FALSE, 33),

                                                                ('Brasil', TRUE, 34),
                                                                ('Alemania', FALSE, 34),
                                                                ('Italia', FALSE, 34),
                                                                ('Argentina', FALSE, 34),

                                                                ('Michelangelo', TRUE, 35),
                                                                ('Donatello', FALSE, 35),
                                                                ('Raphael', FALSE, 35),
                                                                ('Leonardo da Vinci', FALSE, 35),

                                                                ('Avatar', TRUE, 36),
                                                                ('Avengers: Endgame', FALSE, 36),
                                                                ('Titanic', FALSE, 36),
                                                                ('Star Wars: The Force Awakens', FALSE, 36),

                                                                ('Asia', TRUE, 37),
                                                                ('África', FALSE, 37),
                                                                ('América del Norte', FALSE, 37),
                                                                ('Europa', FALSE, 37),

                                                                ('Agua', TRUE, 38),
                                                                ('Oxígeno', FALSE, 38),
                                                                ('Hidrógeno', FALSE, 38),
                                                                ('Helio', FALSE, 38),

                                                                ('Napoleón Bonaparte', TRUE, 39),
                                                                ('Luis XIV', FALSE, 39),
                                                                ('Carlos V', FALSE, 39),
                                                                ('Francisco I', FALSE, 39),

                                                                ('Baloncesto', TRUE, 40),
                                                                ('Fútbol', FALSE, 40),
                                                                ('Béisbol', FALSE, 40),
                                                                ('Hockey', FALSE, 40),

                                                                ('Pablo Picasso', TRUE, 41),
                                                                ('Salvador Dalí', FALSE, 41),
                                                                ('Joan Miró', FALSE, 41),
                                                                ('Diego Velázquez', FALSE, 41),

                                                                ('Thanos', TRUE, 42),
                                                                ('Loki', FALSE, 42),
                                                                ('Ultron', FALSE, 42),
                                                                ('Red Skull', FALSE, 42),

                                                                ('Nilo', TRUE, 43),
                                                                ('Congo', FALSE, 43),
                                                                ('Zambeze', FALSE, 43),
                                                                ('Níger', FALSE, 43),

                                                                ('Corazón', TRUE, 44),
                                                                ('Pulmones', FALSE, 44),
                                                                ('Hígado', FALSE, 44),
                                                                ('Riñones', FALSE, 44),

                                                                ('Augusto', TRUE, 45),
                                                                ('Julio César', FALSE, 45),
                                                                ('Nerón', FALSE, 45),
                                                                ('Calígula', FALSE, 45),

                                                                ('Ciclismo', TRUE, 46),
                                                                ('Atletismo', FALSE, 46),
                                                                ('Natación', FALSE, 46),
                                                                ('Boxeo', FALSE, 46),

                                                                ('Gabriel García Márquez', TRUE, 47),
                                                                ('Jorge Luis Borges', FALSE, 47),
                                                                ('Pablo Neruda', FALSE, 47),
                                                                ('Octavio Paz', FALSE, 47),

                                                                ('Breaking Bad', TRUE, 48),
                                                                ('The Sopranos', FALSE, 48),
                                                                ('The Wire', FALSE, 48),
                                                                ('Mad Men', FALSE, 48);

