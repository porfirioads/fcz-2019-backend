create schema festival_cultural collate latin1_swedish_ci;

create table categoria
(
    id int auto_increment
        primary key,
    nombre varchar(45) not null,
    icono varchar(255) null,
    categoria_padre_id int null,
    link varchar(50) null,
    constraint nombre_UNIQUE
        unique (nombre),
    constraint fk_categoria_categoria
        foreign key (categoria_padre_id) references categoria (id)
            on delete cascade
);

create index fk_categoria_categoria_idx
    on categoria (categoria_padre_id);

create table evento
(
    id int auto_increment
        primary key,
    nombre varchar(100) not null,
    fecha datetime not null,
    tarjeta_frontal varchar(255) default 'uploads/evento_default.png' not null,
    tarjeta_trasera varchar(255) default 'uploads/evento_default.png' not null
);

create table categoria_evento
(
    id int auto_increment
        primary key,
    evento_id int not null,
    categoria_id int not null,
    nombre_campo_orden varchar(45) not null,
    constraint fk_categoria_evento_categoria1
        foreign key (categoria_id) references categoria (id)
            on delete cascade,
    constraint fk_categoria_evento_evento1
        foreign key (evento_id) references evento (id)
            on delete cascade
);

create index fk_categoria_evento_categoria1_idx
    on categoria_evento (categoria_id);

create index fk_categoria_evento_evento1_idx
    on categoria_evento (evento_id);

create table encuesta
(
    id int auto_increment
        primary key,
    procedencia varchar(25) not null,
    sexo varchar(10) not null,
    edad varchar(15) not null,
    evento_id int not null,
    calificacion int not null,
    comentario varchar(300) null,
    constraint fk_encuesta_evento1
        foreign key (evento_id) references evento (id)
);

create index fk_encuesta_evento1_idx
    on encuesta (evento_id);

create table sede
(
    id int auto_increment
        primary key,
    lat double not null,
    lon double not null,
    categoria_id int not null,
    constraint fk_sede_categoria1
        foreign key (categoria_id) references categoria (id)
            on delete cascade
);

create index fk_sede_categoria1_idx
    on sede (categoria_id);

create table usuario
(
    id int auto_increment
        primary key,
    usuario varchar(50) not null,
    password char(40) not null,
    constraint usuario_usuario_uindex
        unique (usuario)
);

