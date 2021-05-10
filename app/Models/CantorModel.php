<?php
namespace App\Models;
use CodeIgniter\Model;

class CantorModel extends Model{

	protected $table = 'cantor';
	protected $allowedFields = ['idcadastro', 'estilo','autoral_cover'];
	protected $primaryKey = 'idcantor';


}