-- Crear base de datos 
CREATE DATABASE IF NOT EXISTS gestorTareasProyectos;
USE gestorTareasProyectos;


CREATE TABLE IF NOT EXISTS Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol_id INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES Roles(id)
);

CREATE TABLE IF NOT EXISTS Proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario_creacion INT,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    FOREIGN KEY (usuario_creacion) REFERENCES Usuarios(id)
);

CREATE TABLE IF NOT EXISTS Tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    tiempo_estimado VARCHAR(50),
    prioridad ENUM('Baja', 'Media', 'Alta'),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    proyecto_id INT,
    estado ENUM('pendiente', 'en progreso', 'completada') DEFAULT 'pendiente',
    FOREIGN KEY (proyecto_id) REFERENCES Proyectos(id)
);

CREATE TABLE IF NOT EXISTS Asignaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarea_id INT,
    usuario_id INT,
    gestor_id INT, 
    proyecto_id INT,
    fecha_asignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
    FOREIGN KEY (tarea_id) REFERENCES Tareas(id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (gestor_id) REFERENCES Usuarios(id), 
    FOREIGN KEY (proyecto_id) REFERENCES Proyectos(id) 
);



INSERT INTO Roles (nombre) VALUES 
('Administrador'),
('Gerente'),
('Usuario');

-- Administrador
INSERT INTO Usuarios (nombre, email, contrasena, rol_id) VALUES ('Miguel', 'admin@example.com', 'adminmiguel', 1);

-- Gestores
INSERT INTO Usuarios (nombre, email, contrasena, rol_id) VALUES 
('Ana', 'anita@example.com', 'gestorana', 2),
('Carlos', 'carlos@example.com', 'gestorcarlos', 2);

-- Usuarios
INSERT INTO Usuarios (nombre, email, contrasena, rol_id) VALUES 
('Sebastian', 'sebastian@example.com', 'usuariosebastian', 3),
('Luccy', 'luccy@example.com', 'usuarioluccy', 3),
('Eliud', 'eliud@example.com', 'usuarioeliud', 3);

-- Proyectos creados por Gestor1
INSERT INTO Proyectos (nombre, descripcion, usuario_creacion) VALUES 
('Desarrollo de una aplicación web', 'Se desarrollará una aplicación web para la gestión de tareas y proyectos.', 2),
('Desarollo de un programa contable', 'Se desarrollará un programa para gestionar contabilidad de pequeñas y medianas empresas.', 2);

-- Proyectos creados por Gestor2
INSERT INTO Proyectos (nombre, descripcion, usuario_creacion) VALUES 
('Desarrollo de un programa de compra y venta de boletos de cine', 'Se desea aplicar un sistema para la compra y venta de boletos en cines para automatizacion en compras.', 3),
('Reingenieria aplicada al sistema del area contable', 'Se realizará una reingeniería del sistema de facturación existente.', 3);

-- Tareas del Proyecto1
INSERT INTO Tareas (nombre, descripcion, tiempo_estimado, prioridad, proyecto_id, estado) VALUES 
('Diseño de la interfaz', 'Diseño de la interfaz de usuario para la aplicación web.', '2 días', 'Media', 1, 'pendiente'),
('Desarrollo del backend', 'Desarrollo del backend de la aplicación web.', '5 días', 'Alta', 1, 'pendiente');

-- Tareas del Proyecto2
INSERT INTO Tareas (nombre, descripcion, tiempo_estimado, prioridad, proyecto_id, estado) VALUES 
('Modelado de la base de datos', 'Creación del modelo de base de datos para el programa contable.', '3 días', 'Alta', 2, 'pendiente'),
('Implementación de la lógica contable', 'Desarrollo de la lógica contable en el programa.', '4 días', 'Media', 2, 'pendiente');

-- Tareas del Proyecto3
INSERT INTO Tareas (nombre, descripcion, tiempo_estimado, prioridad, proyecto_id, estado) VALUES 
('Desarrollo del módulo de compra', 'Desarrollo del módulo para la compra de boletos.', '6 días', 'Alta', 3, 'pendiente'),
('Desarrollo del módulo de venta', 'Desarrollo del módulo para la venta de boletos.', '4 días', 'Media', 3, 'pendiente');

-- Tareas del Proyecto4
INSERT INTO Tareas (nombre, descripcion, tiempo_estimado, prioridad, proyecto_id, estado) VALUES 
('Análisis del sistema actual', 'Análisis del sistema de facturación actual.', '2 días', 'Baja', 4, 'pendiente'),
('Diseño de mejoras', 'Diseño de mejoras para el sistema de facturación.', '3 días', 'Media', 4, 'pendiente');

INSERT INTO Asignaciones (tarea_id, usuario_id, gestor_id, proyecto_id) VALUES 
(1, 4, 2, 1),
(2, 5, 2, 2),
(3, 4, 2, 3),
(4, 6, 2, 4),
(5, 5, 3, 1),
(6, 6, 3, 2),
(7, 4, 3, 3),
(8, 6, 3, 4);

SELECT * FROM Roles;
SELECT * FROM Usuarios;
SELECT * FROM Proyectos;
SELECT * FROM Asignaciones;


