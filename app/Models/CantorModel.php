<?php
namespace App\Models;
use CodeIgniter\Model;

class BandaModel extends Model{

	protected $table = 'cantor';
	protected $allowedFields = ['idcantor','idcadastro', 'estilo','autoral_cover'];
	protected $primaryKey = 'idcadastro';


}