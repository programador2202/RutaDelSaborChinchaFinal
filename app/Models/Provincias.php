<?php

namespace App\Models;
use CodeIgniter\Model;

class Provincias extends Model{

protected $table = 'provincias';
protected $primaryKey = "idprovincia";
protected $allowedFields = ["provincia","iddepartamento"];





}