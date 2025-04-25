-- CREACIÓN DE LA BASE DE DATOS
CREATE DATABASE IF NOT EXISTS steamco CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

-- Acceso a la base de datos
USE steamco;

-- Creación de la tabla de datos de usuarios
CREATE TABLE IF NOT EXISTS users_data(
    idUser INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(60) NOT NULL UNIQUE,
    telefono VARCHAR(15) NOT NULL,
    fnac DATE NOT NULL,
    direccion VARCHAR(200),
    sexo ENUM("Femenino", "Masculino", "Prefiero no responder"),
    PRIMARY KEY(idUser)
)ENGINE = INNODB;

-- Creación de la tabla de inicio de sesión de usuarios
CREATE TABLE IF NOT EXISTS users_login(
    idLogin INT NOT NULL AUTO_INCREMENT,
    idUser INT NOT NULL UNIQUE,
    usuario VARCHAR(60) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    rol ENUM("admin", "user") NOT NULL,
    PRIMARY KEY(idLogin),
    CONSTRAINT fk_user_data FOREIGN KEY (idUser) REFERENCES users_data(idUser)
)ENGINE = INNODB;

-- Creación de la tabla de citas
CREATE TABLE IF NOT EXISTS citas(
    idCita INT NOT NULL AUTO_INCREMENT,
    idUser INT NOT NULL,
    fecha_cita DATE NOT NULL,
    motivo_cita VARCHAR(255),
    PRIMARY KEY(idCita),
    CONSTRAINT fk_user_cita FOREIGN KEY (idUser) REFERENCES users_data(idUser)
)ENGINE = INNODB;

-- Creación de la tabla de citas
CREATE TABLE IF NOT EXISTS noticias(
    idNoticia INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL UNIQUE,
    imagen VARCHAR(150) NOT NULL,
    texto TEXT NOT NULL,
    fecha_creacion DATE NOT NULL,
    idUser INT NOT NULL,
    PRIMARY KEY(idNoticia),
    CONSTRAINT fk_user_noticia FOREIGN KEY (idUser) REFERENCES users_data(idUser)
)ENGINE = INNODB;