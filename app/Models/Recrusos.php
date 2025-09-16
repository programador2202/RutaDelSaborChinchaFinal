<?php

namespace App\Models;
use CodeIgniter\Model;

class Recrusos extends Model{

protected $table = 'recursos';
protected $primaryKey = "idrecurso";
protected $allowedFields = ["idcarta","descripcion","rutarecurso","tiporecurso"];



}