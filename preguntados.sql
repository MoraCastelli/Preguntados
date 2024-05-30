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
);

CREATE TABLE respuesta(
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
