USE sistema_menus;



-- Departamentos (10)
INSERT INTO departamentos (departamento) VALUES
('Lima'),
('Arequipa'),
('Cusco'),
('La Libertad'),
('Piura'),
('Lambayeque'),
('Callao'),
('Junín'),
('Ica'),
('Áncash');

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

INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc, telefono, foto) VALUES
('Ramírez', 'Carlos', 'DNI', '12345678', '987654321', NULL),
('Gómez', 'Lucía', 'DNI', '23456789', '987111222', NULL),
('Fernández', 'María', 'DNI', '34567890', '987333444', NULL),
('Pérez', 'Jorge', 'DNI', '45678901', '987555666', NULL),
('Torres', 'Ana', 'DNI', '56789012', '987777888', NULL),
('Sánchez', 'Luis', 'DNI', '67890123', '987999000', NULL),
('Cruz', 'Elena', 'DNI', '78901234', '986111222', NULL),
('Díaz', 'Pedro', 'DNI', '89012345', '986333444', NULL),
('Morales', 'Rosa', 'DNI', '90123456', '986555666', NULL),
('Salazar', 'Andrés', 'DNI', '11223344', '986777888', NULL);


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

INSERT INTO negocios (idcategoria, idrepresentante, nombre, nombrecomercial, slogan, ruc, logo, banner) VALUES
(1, 1, 'Sushi House', 'Sushi House Perú', 'El mejor sushi en tu mesa', '20111111111', NULL, NULL),
(2, 4, 'Burguer King', 'BK Perú', 'El sabor de la parrilla', '20222222222', NULL, NULL),
(3, 5, 'Pío Rico', 'Pollos Pío Rico', 'Sabrosura en cada bocado', '20333333333', NULL, NULL),
(4, 6, 'Marisquería La Ola', 'La Ola', 'Frescura del mar', '20444444444', NULL, NULL),
(5, 7, 'Restaurante Gourmet 5 Tenedores', 'G5T', 'Exquisitez y elegancia', '20555555555', NULL, NULL),
(6, 8, 'Sabores del Perú', 'Sabores', 'Lo nuestro, con cariño', '20666666666', NULL, NULL),
(7, 9, 'Campo Verde', 'Campestre CV', 'Naturaleza y sabor', '20777777777', NULL, NULL),
(8, 10, 'Café Dulce Aroma', 'Dulce Aroma', 'El café que enamora', '20888888888', NULL, NULL),
(9, 2, 'Parrillas Don José', 'Don José', 'Carnes al carbón', '20999999999', NULL, NULL),
(10, 3, 'Pizza Loca', 'Pizza Loca', 'La pizza que rompe esquemas', '21010101010', NULL, NULL);

INSERT INTO locales (idnegocio, iddistrito, direccion, telefono, latitud, longitud, foto) VALUES
(1, 1, 'Av. Japón 123', '987000111', -12.0464, -77.0428, NULL),
(2, 1, 'Av. Brasil 456', '987000222', -12.0564, -77.0528, NULL),
(3, 1, 'Av. Aviación 789', '987000333', -12.0664, -77.0628, NULL),
(4, 1, 'Av. La Marina 101', '987000444', -12.0764, -77.0728, NULL),
(5, 1, 'Av. Primavera 202', '987000555', -12.0864, -77.0828, NULL),
(6, 1, 'Av. Caminos del Inca 303', '987000666', -12.0964, -77.0928, NULL),
(7, 1, 'Av. Javier Prado 404', '987000777', -12.1064, -77.1028, NULL),
(8, 1, 'Av. Grau 505', '987000888', -12.1164, -77.1128, NULL),
(9, 1, 'Av. San Borja 606', '987000999', -12.1264, -77.1228, NULL),
(10, 1, 'Av. Angamos 707', '987000000', -12.1364, -77.1328, NULL);

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
