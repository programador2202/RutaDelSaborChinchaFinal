<?php

namespace App\Models;
use CodeIgniter\Model;

class Personas extends Model{

protected $table = 'personas';
protected $primaryKey = "idpersona";
protected $allowedFields = ["apellidos","nombres","tipodoc","numerodoc","telefono"];


}