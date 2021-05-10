<?php
namespace App\Models;
use CodeIgniter\Model;

class LinkVideoModel extends Model{

	protected $table = 'linkvideo';
	protected $allowedFields = ['idcadastro', 'link'];
	protected $primaryKey = 'idlinkvideo';


	public function getLinkVideos($id = false){

		if($id == false){
			return null;
		}

		return $this->asArray()
			->where(['idcadastro' => $id])
			->findAll();
	}


}