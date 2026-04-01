CREATE DATABASE tareas_db;

USE tareas_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    password VARCHAR(255),
    rol ENUM('admin', 'usuario')
);

CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    estado BOOLEAN DEFAULT 0,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);