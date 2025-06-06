-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS registro;
USE registro;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100),
    password_cifrada VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS recuperar (
    email VARCHAR (100),
    clavenueva INT (8),
    token VARCHAR (100),
    fechaalta DATETIME
);