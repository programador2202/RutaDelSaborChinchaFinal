CREATE DATABASE sistema_menus;
USE sistema_menus;

CREATE TABLE departamentos (
    iddepartamento INT AUTO_INCREMENT PRIMARY KEY,
    departamento VARCHAR(100) NOT NULL
);

CREATE TABLE provincias (
    idprovincia INT AUTO_INCREMENT PRIMARY KEY,
    provincia VARCHAR(100) NOT NULL,
    iddepartamento INT NOT NULL,
    FOREIGN KEY (iddepartamento) REFERENCES departamentos(iddepartamento)
);

CREATE TABLE distritos (
    iddistrito INT AUTO_INCREMENT PRIMARY KEY,
    distrito VARCHAR(100) NOT NULL,
    idprovincia INT NOT NULL,
    FOREIGN KEY (idprovincia) REFERENCES provincias(idprovincia)
);

CREATE TABLE categorias (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL
);

CREATE TABLE secciones (
    idseccion INT AUTO_INCREMENT PRIMARY KEY,
    seccion VARCHAR(100) NOT NULL
);

CREATE TABLE personas (
    idpersona INT AUTO_INCREMENT PRIMARY KEY,
    apellidos VARCHAR(100) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    tipodoc ENUM('DNI', 'CEX', 'PASAPORTE', 'RUC') NOT NULL,
    numerodoc VARCHAR(15) NOT NULL,
    telefono CHAR(9) NOT NULL
);

CREATE TABLE negocios (
    idnegocio INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT NOT NULL,
    idrepresentante INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    nombrecomercial VARCHAR(100),
    slogan VARCHAR(200),
    ruc CHAR(11) NOT NULL,
    FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria),
    FOREIGN KEY (idrepresentante) REFERENCES personas(idpersona)
);

CREATE TABLE locales (
    idlocales INT AUTO_INCREMENT PRIMARY KEY,
    idnegocio INT NOT NULL,
    iddistrito INT NOT NULL,
    direccion VARCHAR(200) NOT NULL,
    telefono CHAR(9),
    latitud DECIMAL(10,8),
    longitud DECIMAL(11,8),
    FOREIGN KEY (idnegocio) REFERENCES negocios(idnegocio),
    FOREIGN KEY (iddistrito) REFERENCES distritos(iddistrito)
);

CREATE TABLE horarios (
    idhorario INT AUTO_INCREMENT PRIMARY KEY,
    idlocales INT,
    diasemana VARCHAR(20),
    inicio TIME NOT NULL,
    fin TIME NOT NULL,
    FOREIGN KEY (idlocales) REFERENCES locales(idlocales)
);

CREATE TABLE cartas (
    idcarta INT AUTO_INCREMENT PRIMARY KEY,
    idlocales INT NOT NULL,
    idseccion INT NOT NULL,
    nombreplato VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2),
    FOREIGN KEY (idlocales) REFERENCES locales(idlocales),
    FOREIGN KEY (idseccion) REFERENCES secciones(idseccion)
);

CREATE TABLE recursos (
    idrecurso INT AUTO_INCREMENT PRIMARY KEY,
    idcarta INT NOT NULL,
    descripcion VARCHAR(200),
    rutarecurso VARCHAR(200) NOT NULL,
    tiporecurso ENUM('imagen','video') NOT NULL,
    FOREIGN KEY (idcarta) REFERENCES cartas(idcarta)
);

CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    nombreusuario VARCHAR(100) NOT NULL,
    claveacceso VARCHAR(100) NOT NULL,
    nivelacceso VARCHAR(20),
    idpersona INT NOT NULL,
    FOREIGN KEY (idpersona) REFERENCES personas(idpersona)
);

CREATE TABLE contratos (
    idcontrato INT AUTO_INCREMENT PRIMARY KEY,
    idusuario INT NOT NULL,
    idnegocio INT NOT NULL,
    fechainicio DATE NOT NULL,
    fechafin DATE,
    inversion DECIMAL(10,2),
    FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario),
    FOREIGN KEY (idnegocio) REFERENCES negocios(idnegocio)
);

CREATE TABLE comentarios (
    idcomentario INT AUTO_INCREMENT PRIMARY KEY,
    idlocales INT NOT NULL,
    tokenusuario VARCHAR(100) NOT NULL,
    fechahora DATETIME NOT NULL,
    comentario TEXT,
    valoracion INT CHECK (valoracion BETWEEN 1 AND 5),
    FOREIGN KEY (idlocales) REFERENCES locales(idlocales)
);

CREATE TABLE reservas (
    idreserva INT AUTO_INCREMENT PRIMARY KEY,
    idhorario INT NOT NULL,
    fechahora DATETIME NOT NULL,
    cantidadpersonas INT NOT NULL,
    confirmacion BOOLEAN NOT NULL,
    idusuariovalida INT,
    idpersonasolicitud INT NOT NULL,
    FOREIGN KEY (idhorario) REFERENCES horarios(idhorario),
    FOREIGN KEY (idusuariovalida) REFERENCES usuarios(idusuario),
    FOREIGN KEY (idpersonasolicitud) REFERENCES personas(idpersona)
);