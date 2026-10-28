-- Base de datos del sistema de pedidos
DROP DATABASE IF EXISTS ventas_db;
CREATE DATABASE ventas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ventas_db;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(10) NOT NULL UNIQUE,
    apellido VARCHAR(60) NOT NULL,
    nombre VARCHAR(60) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    direccion VARCHAR(120) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL UNIQUE,
    precio DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
) ENGINE=InnoDB;

-- Productos predefinidos (quemados)
INSERT INTO productos (nombre, precio) VALUES
('Jabon', 1.50),
('Shampoo', 4.25),
('Pasta dental', 2.10);

-- Clientes existentes (cargados directo en la base)
INSERT INTO clientes (cedula, apellido, nombre, telefono, direccion) VALUES
('1801234567', 'Perez', 'Juan', '0991234567', 'Av. Cevallos y Mera'),
('1802345678', 'Gomez', 'Maria', '0982345678', 'Calle Bolivar 123'),
('1803456789', 'Lopez', 'Carlos', '0973456789', 'Av. Los Chasquis'),
('1804567890', 'Torres', 'Ana', '0964567890', 'Calle Montalvo 45');
