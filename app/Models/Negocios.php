<?php

namespace App\Models;
use CodeIgniter\Model;

class Negocios extends Model{

protected $table = 'negocios';
protected $primaryKey = "idnegocio";
protected $allowedFields = ["idcategoria","idseccion","idpersona","nombre","nombre_comercial","slogan","ruc"];


}