<?php

namespace App\Models;
use CodeIgniter\Model;

class Secciones extends Model{

protected $table = 'secciones';
protected $primaryKey = "idseccion";
protected $allowedFields = ["seccion"];


}