USE sistema_menus;



-- Departamentos (10)
INSERT INTO departamentos (departamento) VALUES
('Amazonas'),
('Áncash'),
('Apurímac'),
('Arequipa'),
('Ayacucho'),
('Cajamarca'),
('Callao'),
('Cusco'),
('Huancavelica'),
('Huánuco'),
('Ica'),
('Junín'),
('La Libertad'),
('Lambayeque'),
('Lima'),
('Loreto'),
('Madre de Dios'),
('Moquegua'),
('Pasco'),
('Piura'),
('Puno'),
('San Martín'),
('Tacna'),
('Tumbes'),
('Ucayali');


-- Provincias (10) -> cada provincia apunta a un departamento (iddepartamento 1..10)
INSERT INTO provincias (provincia, iddepartamento) VALUES
('Lima', 1),
('Arequipa', 2),
('Cusco', 3),
('Trujillo', 4),
('Piura', 5),
('Chiclayo', 6),
('Callao', 7),
('Huancayo', 8),
('Ica', 9),
('Huaraz', 10);

-- Distritos (10) -> cada distrito apunta a una provincia (idprovincia 1..10)
INSERT INTO distritos (distrito, idprovincia) VALUES
('Miraflores', 1),
('Cerro Colorado', 2),
('Cusco', 3),
('Trujillo', 4),
('Piura', 5),
('Chiclayo', 6),
('Bellavista', 7),
('El Tambo', 8),
('Ica', 9),
('Huaraz', 10);



-- Insertar categorías
INSERT INTO categorias (categoria) VALUES
('Vitinicolas'),
('Comida Oriental'),
('Hamburgueserías'),
('Pollerías'),
('Pescados y Mariscos'),
('Gourmet'),
('Comidas Peruanas'),
('Campestres'),
('Café y Pastelería'),
('Carnes y Parrillas'),
('Pizza'),
('Huariques y Otros');

INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc, telefono) VALUES
('Ramírez', 'Carlos', 'DNI', '12345678', '987654321'),
('Gómez', 'Lucía', 'DNI', '23456789', '987111222'),
('Fernández', 'María', 'DNI', '34567890', '987333444'),
('Pérez', 'Jorge', 'DNI', '45678901', '987555666'),
('Torres', 'Ana', 'DNI', '56789012', '987777888'),
('Sánchez', 'Luis', 'DNI', '67890123', '987999000'),
('Cruz', 'Elena', 'DNI', '78901234', '986111222'),
('Díaz', 'Pedro', 'DNI', '89012345', '986333444'),
('Morales', 'Rosa', 'DNI', '90123456', '986555666'),
('Salazar', 'Andrés', 'DNI', '11223344', '986777888');


INSERT INTO usuarios (nombreusuario, claveacceso, nivelacceso, idpersona) VALUES
('admin1', '123456', 'admin', 1),
('carlosr', '123456', 'representante', 1),
('lucia_g', '123456', 'cliente', 2),
('mariaf', '123456', 'cliente', 3),
('jorgep', '123456', 'representante', 4),
('ana_t', '123456', 'cliente', 5),
('luiss', '123456', 'representante', 6),
('elenac', '123456', 'cliente', 7),
('pedrod', '123456', 'cliente', 8),
('rosa_m', '123456', 'representante', 9);

INSERT INTO negocios (idcategoria, idrepresentante, nombre, nombrecomercial, slogan, ruc, logo) VALUES
-- Categoría 1
(1, 2, 'Sushi King', 'Sushi King Perú', 'Sabor oriental', '21111111111', NULL),
(1, 3, 'Sushi Express', 'Sushi Express', 'Rápido y fresco', '21111111112', NULL),
(1, 4, 'Sushi Paradise', 'Sushi Paraíso', 'Del mar a tu mesa', '21111111113', NULL),
(1, 5, 'Sushi Master', 'Master Sushi', 'Arte en sushi', '21111111114', NULL),
(1, 6, 'Sushi Lovers', 'Sushi Lovers', 'Pasión por el sushi', '21111111115', NULL),

-- Categoría 2
(2, 7, 'Burger Palace', 'Burger Palace', 'El rey de la hamburguesa', '21222222221', NULL),
(2, 8, 'King Burgers', 'King Burgers', 'Sabor que conquista', '21222222222', NULL),
(2, 9, 'Burger Town', 'Burger Town', 'Hamburguesas irresistibles', '21222222223', NULL),
(2, 10, 'Fast Burger', 'Fast Burger', 'Rápido y delicioso', '21222222224', NULL),
(2, 1, 'Burger Spot', 'Burger Spot', 'Tu lugar de hamburguesas', '21222222225', NULL),

-- Categoría 3
(3, 2, 'Pollo Rico', 'Pollo Rico', 'Sabores que enamoran', '21333333331', NULL),
(3, 3, 'Pollos Feliz', 'Pollos Feliz', 'Sabor y tradición', '21333333332', NULL),
(3, 4, 'El Buen Pollo', 'Buen Pollo', 'Del campo a tu plato', '21333333333', NULL),
(3, 5, 'Pollo Dorado', 'Pollo Dorado', 'Crujiente y sabroso', '21333333334', NULL),
(3, 6, 'Pollo Express', 'Pollo Express', 'Rápido y delicioso', '21333333335', NULL),

-- Categoría 4
(4, 7, 'La Mar', 'Mariscos La Mar', 'Frescura del océano', '21444444441', NULL),
(4, 8, 'Mar y Sabor', 'Mar y Sabor', 'Mariscos y más', '21444444442', NULL),
(4, 9, 'Ola Marina', 'Ola Marina', 'Del mar a tu mesa', '21444444443', NULL),
(4, 10, 'El Puerto', 'El Puerto', 'Sabor costero', '21444444444', NULL),
(4, 1, 'Mariscos Express', 'Mariscos Express', 'Rápido y fresco', '21444444445', NULL),

-- Categoría 5
(5, 2, 'Gourmet 5 Estrellas', 'G5E', 'Exquisitez sin igual', '21555555551', NULL),
(5, 3, 'Delicias Gourmet', 'Delicias G', 'Sabor y elegancia', '21555555552', NULL),
(5, 4, 'Alta Cocina', 'Alta Cocina', 'Gastronomía de lujo', '21555555553', NULL),
(5, 5, 'Sabor Supremo', 'Sabor Supremo', 'Placer para tu paladar', '21555555554', NULL),
(5, 6, 'Gourmet Express', 'Gourmet Express', 'Rápido y delicioso', '21555555555', NULL),

-- Categoría 6
(6, 7, 'Sabores Andinos', 'Sabores Andinos', 'Lo nuestro con amor', '21666666661', NULL),
(6, 8, 'Perú Sabe', 'Perú Sabe', 'Tradición y sabor', '21666666662', NULL),
(6, 9, 'Delicias del Perú', 'Delicias Perú', 'Gusto autóctono', '21666666663', NULL),
(6, 10, 'Cocina Criolla', 'Cocina Criolla', 'Sabor peruano', '21666666664', NULL),
(6, 1, 'Perú Gourmet', 'Perú Gourmet', 'Auténtico sabor', '21666666665', NULL),

-- Categoría 7
(7, 2, 'Campo Natural', 'Campo Natural', 'Frescura y salud', '21777777771', NULL),
(7, 3, 'Verde Vida', 'Verde Vida', 'Sabor y naturaleza', '21777777772', NULL),
(7, 4, 'Eco Campo', 'Eco Campo', 'Lo natural primero', '21777777773', NULL),
(7, 5, 'Agro Delicia', 'Agro Delicia', 'Del campo a tu plato', '21777777774', NULL),
(7, 6, 'Granja Verde', 'Granja Verde', 'Productos frescos', '21777777775', NULL),

-- Categoría 8
(8, 7, 'Café Aroma', 'Café Aroma', 'El mejor café', '21888888881', NULL),
(8, 8, 'Dulce Café', 'Dulce Café', 'Para los amantes del café', '21888888882', NULL),
(8, 9, 'Café Express', 'Café Express', 'Rápido y delicioso', '21888888883', NULL),
(8, 10, 'Café Gourmet', 'Café Gourmet', 'Sabor intenso', '21888888884', NULL),
(8, 1, 'Café Natural', 'Café Natural', 'Auténtico aroma', '21888888885', NULL),

-- Categoría 9
(9, 2, 'Parrilla Real', 'Parrilla Real', 'Carnes a la perfección', '21999999991', NULL),
(9, 3, 'Asado Master', 'Asado Master', 'El asado de tu vida', '21999999992', NULL),
(9, 4, 'Don Asado', 'Don Asado', 'Sabor al carbón', '21999999993', NULL),
(9, 5, 'Carne & Sabor', 'Carne & Sabor', 'Para los amantes de la carne', '21999999994', NULL),
(9, 6, 'Parrillas Express', 'Parrillas Express', 'Rápido y sabroso', '21999999995', NULL),

-- Categoría 10
(10, 7, 'Pizza Mania', 'Pizza Mania', 'La pizza que encanta', '21010101011', NULL),
(10, 8, 'Pizza House', 'Pizza House', 'Sabor que conquista', '21010101012', NULL),
(10, 9, 'Pizza Express', 'Pizza Express', 'Rápido y delicioso', '21010101013', NULL),
(10, 10, 'Pizza Gourmet', 'Pizza Gourmet', 'Delicia en cada porción', '21010101014', NULL),
(10, 1, 'Pizza Total', 'Pizza Total', 'El toque perfecto', '21010101015', NULL);





SELECT*FROM negocios;
INSERT INTO locales (idnegocio, iddistrito, direccion, telefono, latitud, longitud) VALUES
(1, 1, 'Av. Japón 123', '987000111', -12.0464, -77.0428),
(2, 1, 'Av. Brasil 456', '987000222', -12.0564, -77.0528),
(3, 1, 'Av. Aviación 789', '987000333', -12.0664, -77.0628),
(4, 1, 'Av. La Marina 101', '987000444', -12.0764, -77.0728),
(5, 1, 'Av. Primavera 202', '987000555', -12.0864, -77.0828),
(6, 1, 'Av. Caminos del Inca 303', '987000666', -12.0964, -77.0928),
(7, 1, 'Av. Javier Prado 404', '987000777', -12.1064, -77.1028),
(8, 1, 'Av. Grau 505', '987000888', -12.1164, -77.1128),
(9, 1, 'Av. San Borja 606', '987000999', -12.1264, -77.1228),
(10, 1, 'Av. Angamos 707', '987000000', -12.1364, -77.1328);

INSERT INTO secciones (seccion) VALUES
('Entradas'),
('Platos de Fondo'),
('Bebidas'),
('Postres'),
('Combos'),
('Especialidades'),
('Promociones'),
('Vegetarianos'),
('Infantil'),
('Sugerencias del Chef');

INSERT INTO cartas (idlocales, idseccion, nombreplato, precio) VALUES
(1, 1, 'Maki Acevichado', 25.00),
(2, 2, 'Hamburguesa Doble', 18.00),
(3, 2, 'Pollo a la Brasa', 45.00),
(4, 2, 'Ceviche Mixto', 30.00),
(5, 2, 'Filete Mignon', 55.00),
(6, 2, 'Lomo Saltado', 28.00),
(7, 2, 'Pachamanca', 60.00),
(8, 3, 'Café Latte', 10.00),
(9, 2, 'Parrilla Mixta', 75.00),
(10, 2, 'Pizza Pepperoni', 32.00);


INSERT INTO recursos (idcarta, descripcion, rutarecurso, tiporecurso) VALUES
(1, 'Foto del Maki Acevichado', 'maki.jpg', 'imagen'),
(2, 'Foto Hamburguesa', 'burger.jpg', 'imagen'),
(3, 'Foto Pollo a la Brasa', 'pollo.jpg', 'imagen'),
(4, 'Foto Ceviche Mixto', 'ceviche.jpg', 'imagen'),
(5, 'Foto Filete Mignon', 'filete.jpg', 'imagen'),
(6, 'Foto Lomo Saltado', 'lomo.jpg', 'imagen'),
(7, 'Foto Pachamanca', 'pachamanca.jpg', 'imagen'),
(8, 'Foto Café Latte', 'cafe.jpg', 'imagen'),
(9, 'Foto Parrilla Mixta', 'parrilla.jpg', 'imagen'),
(10, 'Foto Pizza Pepperoni', 'pizza.jpg', 'imagen');


INSERT INTO horarios (idlocales, diasemana, inicio, fin) VALUES
(1, 'lunes', '09:00:00', '22:00:00'),
(2, 'martes', '09:00:00', '22:00:00'),
(3, 'miercoles', '09:00:00', '22:00:00'),
(4, 'jueves', '09:00:00', '22:00:00'),
(5, 'viernes', '09:00:00', '23:59:00'),
(6, 'sabado', '09:00:00', '23:59:00'),
(7, 'domingo', '09:00:00', '20:00:00'),
(8, 'viernes', '10:00:00', '22:00:00'),
(9, 'sabado', '10:00:00', '22:00:00'),
(10, 'domingo', '10:00:00', '22:00:00');


INSERT INTO reservas (idhorario, fechahora, cantidadpersonas, confirmacion, idusuariovalida, idpersonasolicitud) VALUES
(1, '2025-09-20 19:00:00', 2, 1, 1, 2),
(2, '2025-09-20 20:00:00', 4, 0, NULL, 3),
(3, '2025-09-21 13:00:00', 5, 1, 2, 4),
(4, '2025-09-21 14:00:00', 3, 1, 1, 5),
(5, '2025-09-22 18:00:00', 6, 0, NULL, 6),
(6, '2025-09-22 19:30:00', 2, 1, 3, 7),
(7, '2025-09-23 12:00:00', 8, 1, 2, 8),
(8, '2025-09-23 15:00:00', 4, 0, NULL, 9),
(9, '2025-09-24 20:00:00', 10, 1, 1, 10),
(10, '2025-09-24 21:00:00', 2, 1, 2, 3);


INSERT INTO comentarios (idlocales, tokenusuario, comentario, valoracion) VALUES
(1, 'token1', 'Excelente sushi, muy fresco.', 5),
(2, 'token2', 'Las hamburguesas estaban frías.', 2),
(3, 'token3', 'El pollo a la brasa delicioso.', 5),
(4, 'token4', 'Ceviche normalito, esperaba más.', 3),
(5, 'token5', 'Comida gourmet espectacular.', 5),
(6, 'token6', 'El lomo saltado estaba muy bueno.', 4),
(7, 'token7', 'Un ambiente campestre muy bonito.', 5),
(8, 'token8', 'Buen café, pero poca variedad.', 4),
(9, 'token9', 'La parrilla estaba quemada.', 2),
(10, 'token10', 'La pizza riquísima.', 5);


INSERT INTO contratos (idusuario, idnegocio, fechainicio, fechafin, inversion) VALUES
(2, 1, '2025-01-01', '2025-12-31', 50000.00),
(4, 2, '2025-02-01', '2025-12-31', 40000.00),
(5, 3, '2025-03-01', '2025-12-31', 30000.00),
(6, 4, '2025-04-01', '2025-12-31', 20000.00),
(7, 5, '2025-05-01', '2025-12-31', 60000.00),
(8, 6, '2025-06-01', '2025-12-31', 25000.00),
(9, 7, '2025-07-01', '2025-12-31', 15000.00),
(10, 8, '2025-08-01', '2025-12-31', 10000.00),
(3, 9, '2025-09-01', '2025-12-31', 35000.00),
(1, 10, '2025-10-01', '2025-12-31', 45000.00);
