<?php
namespace App\Models;
use CodeIgniter\Model;

class CategoriaModel extends Model{

	protected $table = 'categoria';
	protected $allowedFields = ['descricao'];
	protected $primaryKey = 'idcategoria';

	public function getCategoria($id = false){

		if($id == false){
			return $this->findAll();
		}

		return $this->asArray()
				->where(['idcategoria' => $id])
				->first();
	}

	public function existeCategoria($id, $descricao){

		$query = $this->query("SELECT * FROM categoria where (descricao = '".$descricao."') and idcategoria != '".$id."'" );

		return $query->getRow();

	}

}