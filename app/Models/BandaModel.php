<?php
namespace App\Models;
use CodeIgniter\Model;

class BandaModel extends Model{

	protected $table = 'banda';
	protected $allowedFields = ['idcadastro', 'estilo','autoral_cover','num_integrantes','nome_integrantes'];
	protected $primaryKey = 'idbanda';


}