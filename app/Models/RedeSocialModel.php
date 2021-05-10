<?php
namespace App\Models;
use CodeIgniter\Model;

class RedeSocialModel extends Model{

	protected $table = 'redesocial';
	protected $allowedFields = ['idcadastro', 'nome','link'];
	protected $primaryKey = 'idredesocial';


	public function getRedeSocial($id  = false){

		if($id == false){
			return null;
		}

		if($id){
			return $this->asArray()
			->where(['idredesocial' => $id])
			->first();
		}

		return null;
	}

	public function getRedesSociais($id = false){

		if($id == false){
			return null;
		}

		return $this->asArray()
			->where(['idcadastro' => $id])
			->findAll();
	}

	public function existeRedeSocial($id, $link){

		$query = $this->query("SELECT * FROM redesocial where (link = '".$link."') and idredesocial != '".$id."'" );

		return $query->getRow();

	}


}