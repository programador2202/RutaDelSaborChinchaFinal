USE sistema_menus;

-- 1. DEPARTAMENTOS
INSERT INTO departamentos (departamento) VALUES
('Lima'), ('Ica');

-- 2. PROVINCIAS
INSERT INTO provincias (provincia, iddepartamento) VALUES
('Lima Metropolitana', 1),
('Chincha', 2);

-- 3. DISTRITOS
INSERT INTO distritos (distrito, idprovincia) VALUES
('Miraflores', 1),
('Surco', 1),
('Chincha Alta', 2);

-- 4. CATEGORÍAS
INSERT INTO categorias (categoria) VALUES
('Restaurante'),
('Cafetería'),
('Pizzería');

-- 5. PERSONAS
INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc, telefono) VALUES
('García Pérez', 'Juan', 'DNI', '12345678', '987654321'),
('Ramírez López', 'María', 'DNI', '87654321', '912345678'),
('Sánchez Torres', 'Carlos', 'DNI', '45678912', '934567890');

-- 6. USUARIOS
INSERT INTO usuarios (nombreusuario, claveacceso, nivelacceso, idpersona) VALUES
('admin01', 'clavehash1', 'admin', 1),
('representante01', 'clavehash2', 'representante', 2),
('cliente01', 'clavehash3', 'cliente', 3);

-- 7. NEGOCIOS
INSERT INTO negocios (idcategoria, idrepresentante, nombre, nombrecomercial, slogan, ruc) VALUES
(1, 2, 'Restaurante El Buen Sabor', 'El Buen Sabor', 'Comida casera con tradición', '20223456789'),
(2, 2, 'Café Aromas', 'Aromas', 'El mejor café de la ciudad', '20988654321');

-- 8. LOCALES
INSERT INTO locales (idnegocio, iddistrito, direccion, telefono, latitud, longitud) VALUES
(1, 1, 'Av. Larco 123, Miraflores', '987111222', -12.121212, -77.032323),
(2, 3, 'Plaza de Armas s/n, Chincha Alta', '987333444', -13.421212, -76.132323);

-- 9. SECCIONES
INSERT INTO secciones (seccion) VALUES
('Entradas'), ('Platos de Fondo'), ('Bebidas');

-- 10. CARTAS
INSERT INTO cartas (idlocales, idseccion, nombreplato, precio) VALUES
(1, 1, 'Causa Limeña', 15.00),
(1, 2, 'Lomo Saltado', 28.00),
(2, 3, 'Café Espresso', 8.00);
