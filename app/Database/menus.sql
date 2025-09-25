CREATE DATABASE sistema_menus;

drop database sistema_menus;
USE sistema_menus;




-- 1. DEPARTAMENTOS
CREATE TABLE departamentos (
    iddepartamento INT AUTO_INCREMENT PRIMARY KEY,
    departamento VARCHAR(100) NOT NULL UNIQUE
);

-- 2. PROVINCIAS
CREATE TABLE provincias (
    idprovincia INT AUTO_INCREMENT PRIMARY KEY,
    provincia VARCHAR(100) NOT NULL UNIQUE,
    iddepartamento INT NOT NULL,
    FOREIGN KEY (iddepartamento) REFERENCES departamentos(iddepartamento)
);

-- 3. DISTRITOS
CREATE TABLE distritos (
    iddistrito INT AUTO_INCREMENT PRIMARY KEY,
    distrito VARCHAR(100) NOT NULL,
    idprovincia INT NOT NULL,
    FOREIGN KEY (idprovincia) REFERENCES provincias(idprovincia)
);

-- 4. CATEGORÍAS 
CREATE TABLE categorias (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL
);

-- 5. PERSONAS (con foto de perfil opcional)
CREATE TABLE personas (
    idpersona INT AUTO_INCREMENT PRIMARY KEY,
    apellidos VARCHAR(100) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    tipodoc VARCHAR(20) NOT NULL,
    numerodoc VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL
);

-- 6. USUARIOS
CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    nombreusuario VARCHAR(50) UNIQUE NOT NULL,
    claveacceso VARCHAR(255) NOT NULL,
    nivelacceso ENUM('admin','representante','cliente') DEFAULT 'cliente',
    idpersona INT NOT NULL,
    FOREIGN KEY (idpersona) REFERENCES personas(idpersona)
);

-- 7. NEGOCIOS (con logo y banner opcionales)
CREATE TABLE negocios (
    idnegocio INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT NOT NULL,
    idrepresentante INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    nombrecomercial VARCHAR(150),
    slogan VARCHAR(255),
    ruc VARCHAR(20) UNIQUE,
    logo VARCHAR(255) NULL,
    FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria),
    FOREIGN KEY (idrepresentante) REFERENCES personas(idpersona)
);

SELECT*FROM negocios;

-- 8. LOCALES (con foto principal opcional)
CREATE TABLE locales (
    idlocales INT AUTO_INCREMENT PRIMARY KEY,
    idnegocio INT NOT NULL,
    iddistrito INT NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    latitud DECIMAL(10,8),
    longitud DECIMAL(11,8),
    foto VARCHAR(255) NULL,
   FOREIGN KEY (idnegocio) REFERENCES negocios(idnegocio) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    FOREIGN KEY (iddistrito) REFERENCES distritos(iddistrito)
);

-- 9. CARTAS
CREATE TABLE cartas (
    idcarta INT AUTO_INCREMENT PRIMARY KEY,
    idlocales INT NOT NULL,
    idseccion INT NOT NULL,
    nombreplato VARCHAR(150) NOT NULL,
    precio DECIMAL(10,2),
    FOREIGN KEY (idlocales) REFERENCES locales(idlocales)
);

-- 10. SECCIONES
CREATE TABLE secciones (
    idseccion INT AUTO_INCREMENT PRIMARY KEY,
    seccion VARCHAR(100) NOT NULL
);

-- Vinculamos CARTAS con SECCIONES
ALTER TABLE cartas
    ADD CONSTRAINT fk_cartas_seccion FOREIGN KEY (idseccion) REFERENCES secciones(idseccion);

-- 11. RECURSOS (para imágenes/videos de platos)
CREATE TABLE recursos (
    idrecurso INT AUTO_INCREMENT PRIMARY KEY,
    idcarta INT NOT NULL,
    descripcion VARCHAR(255),
    rutarecurso VARCHAR(255),
    tiporecurso ENUM('imagen','video'),
    FOREIGN KEY (idcarta) REFERENCES cartas(idcarta)
);

-- 12. HORARIOS
CREATE TABLE horarios (
    idhorario INT AUTO_INCREMENT PRIMARY KEY,
    idlocales INT NOT NULL,
    diasemana ENUM('lunes','martes','miercoles','jueves','viernes','sabado','domingo'),
    inicio TIME,
    fin TIME,
    FOREIGN KEY (idlocales) REFERENCES locales(idlocales)
);

-- 13. RESERVAS
CREATE TABLE reservas (
    idreserva INT AUTO_INCREMENT PRIMARY KEY,
    idhorario INT NOT NULL,
    fechahora DATETIME NOT NULL,
    cantidadpersonas INT,
    confirmacion BOOLEAN DEFAULT 0,
    idusuariovalida INT,
    idpersonasolicitud INT NOT NULL,
    FOREIGN KEY (idhorario) REFERENCES horarios(idhorario),
    FOREIGN KEY (idusuariovalida) REFERENCES usuarios(idusuario),
    FOREIGN KEY (idpersonasolicitud) REFERENCES personas(idpersona)
);

-- 14. COMENTARIOS
CREATE TABLE comentarios (
    idcomentario INT AUTO_INCREMENT PRIMARY KEY,
    idlocales INT NOT NULL,
    tokenusuario VARCHAR(100),
    fechahora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    comentario TEXT,
    valoracion INT CHECK(valoracion >= 1 AND valoracion <= 5),
    FOREIGN KEY (idlocales) REFERENCES locales(idlocales)
);

-- 15. CONTRATOS
CREATE TABLE contratos (
    idcontrato INT AUTO_INCREMENT PRIMARY KEY,
    idusuario INT NOT NULL,
    idnegocio INT NOT NULL,
    fechainicio DATE,
    fechafin DATE,
    inversion DECIMAL(12,2),
    FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario),
    FOREIGN KEY (idnegocio) REFERENCES negocios(idnegocio)
);
