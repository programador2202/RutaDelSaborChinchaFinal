<?php

namespace App\Models;
use CodeIgniter\Model;

class Negocio extends Model{

protected $table = 'negocios';
protected $primaryKey = "idnegocio";
protected $allowedFields = ["idcategoria","idseccion","idpersona","nombre","nombre_comercial","slogan","ruc","logo","banner"];


}