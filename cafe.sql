CREATE DATABASE coffee_house;
USE coffee_house;


CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    fecha_contratacion DATE NOT NULL
);
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    fecha DATE NOT NULL
);

INSERT INTO empleados (nombre, cargo, email, fecha_contratacion) 
VALUES
('Juan Pérez', 'Barista', 'juan@coffeehouse.com', '2022-06-15'),
('Maria González', 'Cajera', 'maria@coffeehouse.com', '2023-03-10'),
('Carlos Sánchez', 'Gerente', 'carlos@coffeehouse.com', '2021-11-20');

INSERT INTO productos (nombre, precio, fecha) 
VALUES
('Café Espresso', 2.50, '2024-10-01'),
('Café Latte', 3.00, '2024-10-01'),
('Café Mocha', 3.50, '2024-10-01');


