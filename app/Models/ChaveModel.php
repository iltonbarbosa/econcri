<?php
namespace App\Models;
use CodeIgniter\Model;

class ChaveModel extends Model{

	protected $table = 'chaverecsenha';
	protected $allowedFields = ['chave','email'];
	protected $primaryKey = 'idchave';


	public function validaChave($chave){

		$query = $this->query("SELECT email FROM chaverecsenha WHERE chave = '".$chave."'");

		return $query->getResult('array');

	}

	public function excluir($email){

		$this->query("DELETE FROM chaverecsenha WHERE email = '".$email."'");

	}
	
}