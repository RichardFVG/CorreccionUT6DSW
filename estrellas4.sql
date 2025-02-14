-- 1. Creo la base de datos valoracion_stars si no existe
CREATE DATABASE IF NOT EXISTS valoracion_stars;

-- 2. Uso la base de datos recién creada (o la ya existente)
USE valoracion_stars;

-- 3. Tabla 'productos'
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- 4. Inserto algunos registros de ejemplo en 'productos'
INSERT INTO productos (nombre, descripcion, precio) VALUES
('Acer AX3950 I5-650 4GB 1TB W7HP 10mp', 'PC de escritorio con procesador Intel Core i5', 500.00),
('Archos Clipper MP3 64GB Negro', 'Reproductor de música MP3 con 64GB', 30.00),
('Sony Bravia 32IN FULLHD KDL-32BX400', 'Televisor Sony Bravia de 32 pulgadas', 200.00),
('Asus EEEPC 1005PXD N455 1 250 BL', 'Netbook Asus con procesador Intel N455', 150.00),
('HP Mini 110-3120 10.1LED N455 1GB 250GB W7S negro', 'Mini PC HP con pantalla de 10.1 pulgadas', 180.00),
('Canon Ixus 115HS azul', 'Cámara compacta Canon Ixus 115HS', 120.00),
('Kingston DataTraveler 16GB DT101G2 USB2.0 negro', 'Pendrive Kingston de 16GB', 10.00),
('Kingston DataTraveler G3 32GB rojo', 'Pendrive Kingston de 32GB', 15.00),
('Kingston MicroSDHC 8GB', 'Tarjeta MicroSD Kingston de 8GB', 8.00),
('Canon Legira FS306 Plata', 'Cámara de video Canon Legira FS306', 220.00),
('LG TDT HD 23 M237WDP-PC FULL HD', 'Televisor LG con sintonizador TDT HD', 350.00);

-- 5. Tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    usuario VARCHAR(20) PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

-- 6. Inserto usuarios de ejemplo
INSERT INTO usuarios (usuario, password) VALUES
('admin', '1234'),   -- Contraseña '1234'
('ana', '4321');     -- Contraseña '4321'

-- 7. Tabla 'votos'
CREATE TABLE IF NOT EXISTS votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cantidad INT DEFAULT 0,
    idPr INT NOT NULL,
    idUs VARCHAR(20) NOT NULL,
    CONSTRAINT fk_votos_usu
        FOREIGN KEY (idUs)
        REFERENCES usuarios(usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_votos_pro
        FOREIGN KEY (idPr)
        REFERENCES productos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- 8. Inserto votos de ejemplo para 'admin'
INSERT INTO votos (cantidad, idPr, idUs) VALUES
(5, 1, 'admin'),
(4, 2, 'admin'),
(3, 3, 'admin'),
(4, 4, 'admin'),
(5, 5, 'admin'),
(3, 6, 'admin'),
(4, 7, 'admin'),
(2, 8, 'admin'),
(3, 9, 'admin'),
(5, 10, 'admin');

-- 9. Inserto algunos votos para 'ana'
INSERT INTO votos (cantidad, idPr, idUs) VALUES
(5, 1, 'ana'),
(4, 2, 'ana'),
(3, 3, 'ana'),
(4, 4, 'ana'),
(5, 5, 'ana');
