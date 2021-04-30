<?php
namespace App\Models;
use CodeIgniter\Model;

class AgendaModel extends Model{

	protected $table = 'agenda';
	protected $allowedFields = ['idagenda','idcadastro', 'dtagenda','hora', 'local'];
	protected $primaryKey = 'idagenda';

	public function getAgenda($id  = false){

		if($id == false){
			return null;
		}

		if($id){
			return $this->asArray()
			->where(['idagenda' => $id])
			->first();
		}

		return null;
	}

	public function getAgendas($id = false){

		if($id == false){
			return null;
		}

		return $this->asArray()
			->where(['idcadastro' => $id])
			->findAll();
	}

	public function existeAgenda($id, $data, $hora){

		$query = $this->query("SELECT * FROM agenda where (dtagenda = '".$data."') and (hora = '".$hora."') and idagenda != '".$id."'" );

		return $query->getRow();

	}


}