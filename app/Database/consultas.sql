
INSERT INTO departamentos (departamento) VALUES
('Ica'), ('Lima'), ('Arequipa'), ('Cusco'), ('Piura');

INSERT INTO provincias (provincia, iddepartamento) VALUES
('Chincha', 1), ('Pisco', 1), ('Ica', 1), ('Lima', 2), ('Arequipa', 3);

INSERT INTO distritos (distrito, idprovincia) VALUES
('Chincha Alta', 1), ('Sunampe', 1), ('Tambo de Mora', 1), ('San Juan de Miraflores', 4), ('Cercado', 5);


INSERT INTO categorias (categoria) VALUES
('Pollería'), ('Pizzería'), ('Mariscos'), ('Cafetería'), ('Chifa');

INSERT INTO secciones (seccion) VALUES
('Entradas'), ('Platos de Fondo'), ('Bebidas'), ('Postres'), ('Promociones');


INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc, telefono) VALUES
('García Pérez', 'Juan', 'DNI', '12345678', '987654321'),
('Rojas Díaz', 'María', 'DNI', '87654321', '912345678'),
('López Chávez', 'Carlos', 'DNI', '56781234', '923456789'),
('Fernández Soto', 'Lucía', 'DNI', '43218765', '934567890'),
('Torres Ramos', 'Pedro', 'DNI', '11112222', '945678901');


INSERT INTO negocios (idcategoria, idrepresentante, nombre, nombrecomercial, slogan, ruc) VALUES
(1, 1, 'Pollos Don Juan', 'Don Juan', 'El mejor pollo a la brasa', '20123456789'),
(2, 2, 'Pizza Bella', 'Bella Pizza', 'El auténtico sabor italiano', '20112233445'),
(3, 3, 'Marisquería El Puerto', 'El Puerto', 'Sabores del mar a tu mesa', '20987654321'),
(4, 3, 'Café Aroma', 'Aroma Café', 'Pasión por el café', '20876543210'),
(5, 4, 'Chifa Pekín', 'Pekín', 'Sabor oriental en cada plato', '20765432109');


INSERT INTO locales (idnegocio, iddistrito, direccion, telefono, latitud, longitud) VALUES
(1, 1, 'Av. Grau 123, Chincha Alta', '956123456', -13.40960000, -76.13250000),
(2, 2, 'Jr. Lima 456, Sunampe', '956654321', -13.42000000, -76.14000000),
(3, 3, 'Malecón 789, Tambo de Mora', '987111222', -13.41500000, -76.13500000),
(4, 4, 'Av. Los Héroes 101, SJM', '944222333', -12.15800000, -77.00800000),
(5, 5, 'Plaza de Armas, Arequipa', '955333444', -16.39890000, -71.53690000);

-- =============================
-- HORARIOS
-- =============================
INSERT INTO horarios (idlocales, diasemana, inicio, fin) VALUES
(1, 'Lunes a Viernes', '10:00:00', '22:00:00'),
(2, 'Todos los días', '11:00:00', '23:00:00'),
(3, 'Sábado y Domingo', '09:00:00', '21:00:00'),
(4, 'Lunes a Viernes', '08:00:00', '20:00:00'),
(5, 'Todos los días', '12:00:00', '00:00:00');

-- =============================
-- CARTAS
-- =============================
INSERT INTO cartas (idlocales, idseccion, nombreplato, precio) VALUES
(1, 2, 'Pollo a la brasa', 35.00),
(2, 2, 'Pizza Napolitana', 25.00),
(3, 2, 'Ceviche de pescado', 28.00),
(4, 3, 'Capuccino', 12.00),
(5, 2, 'Arroz chaufa', 20.00);

-- =============================
-- RECURSOS (imágenes de platos)
-- =============================
INSERT INTO recursos (idcarta, descripcion, rutarecurso, tiporecurso) VALUES
(1, 'Pollo a la brasa con papas fritas', 'img/pollo.jpg', 'imagen'),
(2, 'Pizza napolitana artesanal', 'img/pizza.jpg', 'imagen'),
(3, 'Ceviche fresco con camote', 'img/ceviche.jpg', 'imagen'),
(4, 'Café capuccino espumoso', 'img/capuccino.jpg', 'imagen'),
(5, 'Arroz chaufa con pollo', 'img/chaufa.jpg', 'imagen');

-- =============================
-- USUARIOS
-- =============================
INSERT INTO usuarios (nombreusuario, claveacceso, nivelacceso, idpersona) VALUES
('jgarcia', '12345', 'admin', 1),
('mrojas', '12345', 'editor', 2),
('clopez', '12345', 'cliente', 3),
('lfernandez', '12345', 'cliente', 4),
('ptorres', '12345', 'editor', 5);

-- =============================
-- CONTRATOS
-- =============================
INSERT INTO contratos (idusuario, idnegocio, fechainicio, fechafin, inversion) VALUES
(1, 1, '2024-01-01', '2024-12-31', 5000.00),
(2, 2, '2024-02-01', '2024-08-01', 3000.00),
(3, 3, '2024-03-01', NULL, 4000.00),
(4, 4, '2024-04-01', '2024-10-01', 2500.00),
(5, 5, '2024-05-01', NULL, 3500.00);

-- =============================
-- COMENTARIOS
-- =============================
INSERT INTO comentarios (idlocales, tokenusuario, fechahora, comentario, valoracion) VALUES
(1, 'token123', NOW(), 'Excelente atención y buen pollo.', 5),
(2, 'token234', NOW(), 'La pizza muy rica, pero demoró un poco.', 4),
(3, 'token345', NOW(), 'El ceviche fresco, recomendado.', 5),
(4, 'token456', NOW(), 'El café estaba algo frío.', 3),
(5, 'token567', NOW(), 'Muy buen servicio en general.', 5);


INSERT INTO reservas (idhorario, fechahora, cantidadpersonas, confirmacion, idusuariovalida, idpersonasolicitud) VALUES
(1, '2024-06-01 19:00:00', 4, TRUE, 1, 2),
(2, '2024-06-02 20:00:00', 2, FALSE, NULL, 3),
(3, '2024-06-03 13:00:00', 6, TRUE, 2, 4),
(4, '2024-06-04 18:00:00', 3, TRUE, 3, 5),
(5, '2024-06-05 21:00:00', 5, FALSE, NULL, 1);
