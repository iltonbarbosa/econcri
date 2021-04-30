<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{

	protected $table = 'usuario';
	protected $allowedFields = ['idusuario', 'nome', 'email', 'senha', 'perfil','dadosconfirmados'];
	protected $primaryKey = 'idusuario';
	protected $dateFormat = 'datetime';
	protected $createdField = 'dtcadastro';

	protected $beforeInsert = [
		'gerarId' // this is ben called from the trait
	];

	protected function gerarId(array $data){
		$data['data']['idusuario'] = md5(uniqid(rand(), true));

		return $data;
	}

	public function verificaUsuario($email, $senha){

		return $this->asArray()
				->where(['email' => $email, 'senha' => md5($senha)])
				->first();
	}

	public function existeUsuario($id, $email, $nome){

		$query = $this->query("SELECT * FROM usuario where (nome = '".$nome."' or email = '".$email."') and idusuario != '".$id."'" );

		return $query->getRow();

	}

	public function getUsuario($id = false){

		if($id == false){
			return $this->findAll();
		}
		
		return $this->asArray()
				->where(['idusuario' => $id])
				->first();
	}

}