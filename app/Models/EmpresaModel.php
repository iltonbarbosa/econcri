<?php
namespace App\Models;
use CodeIgniter\Model;

class EmpresaModel extends Model{

	protected $table = 'empresa';
	protected $allowedFields = ['idempresa','idcadastro', 'cnpj'];
	protected $primaryKey = 'idempresa';


}