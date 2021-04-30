<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\UserModel;

class Usuarios extends BaseController{

	var $model = null;

	public function __construct(){
		$this->model = new UserModel();
	}

	public function index()	{
		
		$data = [
			'title' => 'Usuários',
			'subtitulo' => 'Inserir',
			'usuarios' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'msg' => ''
		];
		
		$this->exibeView($data);
	}

	public function editar($id = null)	{
		
		$data = [
			'title' => 'Usuários',
			'subtitulo' => 'Editar',
			'usuario' => $this->model->getUsuario($id),
			'usuarios' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'msg' => ''
		];

		if(empty($data['usuario']))
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Não foi encontrado um usuário com este registro.');

			$this->exibeView($data);
	}

	public function gravar(){

		$idusuario = $this->request->getVar('id');
		$nome = $this->request->getVar('nome');
		$email = $this->request->getVar('email');
		if($this->request->getVar('senha'))
			$senha = md5($this->request->getVar('senha'));
		if($this->request->getVar('confirmasenha'))	
			$confirmasenha = md5($this->request->getVar('confirmasenha'));
		$perfil = $this->request->getVar('perfil');

		helper('form');

		$valida = 0;

		if($idusuario != null){
			$valida = $this->validate([
				'nome' => ['label' => 'Nome', 'rules' => 'required|min_length[3]'],
				'email' => ['label' => 'E-mail', 'rules' => 'required|min_length[5]']
				]);
			if($valida && $this->model-> existeUsuario($idusuario, $email, $nome))
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

			if($perfil === null)
				$perfil = 2;

			if(isset($senha))	
				$data = [
					'idusuario' =>$idusuario,
					'nome' => $nome,
					'email' => $email,
					'senha' => $senha,
					'perfil' => $perfil
				];  
			else
				$data = [
					'idusuario' =>$idusuario,
					'nome' => $nome,
					'email' => $email,
					'perfil' => $perfil
				]; 	

			$this->model->save($data);

			$msg = 'Dados gravados com sucesso!';

		}else {
			$msg = 'Erro ao cadastrar usuári@!';
		}

		$data = [
			'title' => 'Usuários',
			'subtitulo' => 'Inserir',
			'usuario' =>['idusuario' => $idusuario, 'nome' => $nome, 'email' => $email],
			'usuarios' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'msg' => $msg
		];

		$this->exibeView($data);
	}


	public function excluir($id = null){

		if($id)
			$this->model->delete(['idusuario' => $id]);

		return redirect()->to(base_url('controle/usuarios'));
	}

	public function alterarSenha(){

		$id = $this->request->getVar('id');

		$data = [
			'senha' => md5($this->request->getVar('senha'))
		];

		$this->model->update($id, $data);

		return redirect()->to(base_url('controle/usuarios'));
	}

	private function exibeView($data){
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/usuarios');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

}
