<?php


namespace App\Models;
use CodeIgniter\Model;

class Negocio extends Model {
    protected $table = 'negocios';
    protected $primaryKey = 'idnegocio';
    protected $allowedFields = [
        'idcategoria','idrepresentante','nombre','nombrecomercial',
        'slogan','ruc','logo'
    ];
    
}



    //CREATE TABLE negocios (
    //idnegocio INT AUTO_INCREMENT PRIMARY KEY,
    //idcategoria INT NOT NULL,
    //idrepresentante INT NOT NULL,
    //nombre VARCHAR(150) NOT NULL,
    //nombrecomercial VARCHAR(150),
    //slogan VARCHAR(255),
    //ruc VARCHAR(20) UNIQUE,
    //logo VARCHAR(255) NULL,
    //banner VARCHAR(255) NULL,
    //FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria),
    //FOREIGN KEY (idrepresentante) REFERENCES personas(idpersona)


