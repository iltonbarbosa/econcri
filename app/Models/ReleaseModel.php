<?php
namespace App\Models;
use CodeIgniter\Model;

class ReleaseModel extends Model{

	protected $table = 'release';
	protected $allowedFields = ['idrelease','idcadastro', 'release','linkportfolio','palavrachave'];
	protected $primaryKey = 'idcadastro';//só consegui deletar assim

	public function getRelease($id){

		if($id){
			return $this->asArray()
			->where(['idcadastro' => $id])
			->first();
		}

		return null;
	}


}