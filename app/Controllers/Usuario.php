<?php 
namespace App\Controllers; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
	public function index()	{
		
		$data = [
			'title' => 'Cadastro',
			'subtitulo' => 'Cadastrar',
			'msg' => ''
		];
		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/usuario');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}


	public function gravar(){

		$model = new UsuarioModel();

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
				'email' => ['label' => 'E-mail', 'rules' => 'required|valid_email']
				],
				[   // Errors
					'email' => ['valid_email' => 'O e-mail deve ser válido e único neste sistema.']
				]);

			$existe = $model-> existeUsuario($idusuario, $email, $nome);		

			if($valida && $existe)
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

			$this->enviaEmail($email);

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
			echo view('/pages/usuario', $data);
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}


	private function enviaEmail($emailAdress){

		$subject = "Bem-vindo ao sistema Econcri";
		$message = "Seu cadastro foi realizado com sucesso. Agora é necessário acessar o sistema e preencher o seu cadastro de artista. Poderá também cadastrar outros artistas do seu conhecimento.";

		$message .= "<p>Acesso: <a href='".base_url('/')."'> Sistema Econcri</a></p>";
		
		$email = \Config\Services::email();

		$email->setTo($emailAdress);
		$email->setFrom('sistemaeconcri@gmail.com', 'Bem-vindo ao sistema Econcri!');
		
		$email->setSubject($subject);
		$email->setMessage($message);

		if ($email->send()) {
			$msg = 'Email enviado com sucesso!';
		} 
		else {
			$msg = 'Erro no envio da mensagem!';
			$data = $email->printDebugger(['headers']);
			print_r($data);
		}
	}



}
