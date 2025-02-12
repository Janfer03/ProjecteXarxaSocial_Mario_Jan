--establecer la codificación 
SET NAMES utf8mb4;
SET character_set_client = 'utf8mb4';
SET character_set_connection = 'utf8mb4';
SET character_set_results = 'utf8mb4';
SET collation_connection = 'utf8mb4_bin';

--crear la base de datos 
CREATE DATABASE IF NOT EXISTS EduForum
CHARACTER SET utf8mb4
COLLATE utf8mb4_bin;

--seleccionar la base de datos creada
USE EduForum;

--crear la tabla 'users'
CREATE TABLE IF NOT EXISTS users (
    iduser INT AUTO_INCREMENT PRIMARY KEY,                          -- Clave primaria autoincrementable
    mail VARCHAR(40) NOT NULL UNIQUE,                               -- Correo único
    username VARCHAR(16) NOT NULL UNIQUE,                           -- Nombre de usuario único
    passHash VARCHAR(60) NOT NULL,                                  -- Hash de la contraseña
    userFirstName VARCHAR(60) NOT NULL,                             -- Nombre del usuario
    userLastName VARCHAR(120) NOT NULL,                             -- Apellido del usuario
    creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,       -- Fecha de creación
    removeDate DATETIME DEFAULT NULL,                               -- Fecha de eliminación (puede ser NULL)
    lastSignIn DATETIME DEFAULT NULL,                               -- Último inicio de sesión
    active TINYINT(1) NOT NULL DEFAULT 1,                           -- Indica si el usuario está activo

    --nuevos campos_1

    activationDate DATETIME,                                        -- Fecha de activacion de la cuenta
    activationCode VARCHAR(64),                                        -- Codigo de activacion
    resetPassExpiry DATETIME,                                       -- Fecha de pass expiry
    resetPassCode VARCHAR(64)                                          -- Codigo de reset pass

) ENGINE=InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_bin;