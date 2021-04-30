<?php 
namespace App\Controllers; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\UserModel;

class Cadastro extends BaseController
{
	public function index()	{
		
		$data = [
			'title' => 'Cadastro',
			'subtitulo' => 'Cadastrar',
			'msg' => ''
		];
		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/cadastro');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}


	public function gravar(){

		$model = new UserModel();

		$idusuario = $this->request->getVar('id');
		$nome = $this->request->getVar('nome');
		$email = $this->request->getVar('email');
		$senha = md5($this->request->getVar('senha'));
		$confirmasenha = md5($this->request->getVar('confirmasenha'));
		$perfil =2;//usuário

		helper('form');

		$valida = 0;

		if($idusuario != null){
			$valida = $this->validate([
				'nome' => ['label' => 'Nome', 'rules' => 'required|min_length[3]'],
				'email' => ['label' => 'E-mail', 'rules' => 'required|min_length[5]']
				]);
			if($valida && $model-> existeUsuario($idusuario, $email, $nome))
				$msg = "O usuário ou e-mail já existe no sistema em outro registro";
			
		}else{
			$valida = $this->validate([
				'nome' => ['label' => 'Nome', 'rules' => 'required|min_length[3]|is_unique[usuario.nome]'],
				'email' => ['label' => 'E-mail', 'rules' => 'required|min_length[5]|is_unique[usuario.email]'],
				'senha' => ['label' => 'Senha', 'rules' => 'required|min_length[5]'],
				'confirmasenha' => ['label' => 'Confirma Senha', 'rules' => 'required|matches[senha]']

				]);
		}

		if($valida){

			$data = [
				'idusuario' =>$idusuario,
				'nome' => $nome,
				'email' => $email,
				'senha' => $senha,
				'perfil' => $perfil
			];  

			$model->save($data);

			$msg = 'Dados gravados com sucesso!';

		}else {
			$msg = 'Erro ao cadastrar usuári@!';
		}

		$data = [
			'title' => 'Usuários',
			'usuario' =>['idusuario' => '','nome' => $nome, 'email' => $email],
			'subtitulo' => 'Cadastrar',
			'msg' => $msg
		];

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		if($msg === 'Dados gravados com sucesso!')
			echo view('/pages/oquecadastrar', $data);
		else
			echo view('/pages/cadastro', $data);
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}



}
