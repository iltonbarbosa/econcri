<?php 
namespace App\Controllers; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\ChaveModel;

class Login extends BaseController
{
	public function index()
	{
		$data['title'] = 'login_errors';
		echo view('backend/templates/html-header', $data);
		echo view('backend/pages/login');
		echo view('backend/templates/footer');
	}

	public function entrar(){
		$model = new UsuarioModel();

		$email = $this->request->getVar('email');
		$senha = $this->request->getVar('senha');
		$cancelar = $this->request->getVar('cancelar');

		if($cancelar !== null)
		return redirect()->to(base_url('/'));

		$data['usuario'] = $model->verificaUsuario($email, $senha);

		if(empty($data['usuario'])){
			return redirect()->to(base_url('Login'));
		}else{

			$sessionData = [
				'user' => $data['usuario']['nome'],
				'idusuario' => $data['usuario']['idusuario'],
				'perfil' => $data['usuario']['perfil'],
				'logged_in' => TRUE
			];

			session()->set($sessionData);

			return redirect()->to(base_url('controle'));
		}
	}

	public function logout(){
		session()->destroy();
		return redirect()->to(base_url('/'));

	}

	public function RecuperarSenha($msg = false){
		if($msg != false)
		   $data['msg'] = $msg;

		$data['title'] = 'Econcri';
		echo view('backend/templates/html-header', $data);
		echo view('backend/pages/recuperarSenha');
		echo view('backend/templates/footer');
	}

	public function EnviaEmailRecSenha(){
		//https://www.positronx.io/codeigniter-send-email-with-smtp-tutorial-with-example/

		$emailAdress = $this->request->getVar('email');

		if($this->verificaEmailExiste($emailAdress)){

			$subject = "Recuperação da senha do sistema Econcri";
			$message = "Clique no link abaixo para criar uma nova senha";

			$chave = $this->gerarChave($emailAdress);

			$message .= "<p><a href='".base_url('/Login/criarNovaSenha/')."/".$chave."'> Clique aqui para criar sua nova senha</a></p>";
			
			$email = \Config\Services::email();

			$email->setTo($emailAdress);
			$email->setFrom('sistemaeconcri@gmail.com', 'Recuperação de senha');
			
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
		}else
			$msg = "Este e-mail informado não está cadastrado no sistema.";

		$this->RecuperarSenha($msg);
	}

	public function verificaEmailExiste($email){
		$model = new UsuarioModel();

		return $model->verificaEmailExiste($email);
	}

	public function criarNovaSenha($chave){
		$model = new ChaveModel();
		$data['msg'] = '';

		$email = $model->validaChave($chave);

		if(!$email){
			$data['msg'] = "Chave inválida ou já utilizada.";
			return $this-> RecuperarSenha($data['msg']);
		}

		$data['msg'] = "Seu e-mail - ".$email[0]['email'];
		$data['email'] = $email[0]['email'];
		$data['title'] = 'Nova Senha';
		echo view('backend/templates/html-header', $data);
		echo view('backend/pages/novasenha');
		echo view('backend/templates/footer');

	}

	public function gravarNovaSenha(){
		$email = $this->request->getVar('email');
		$senha = $this->request->getVar('senha');
		$confirmasenha = $this->request->getVar('confirmasenha');

		helper('form');

		$valida = $this->validate([
			'senha' => ['label' => 'Senha', 'rules' => 'required|min_length[5]'],
			'confirmasenha' => ['label' => 'Confirma Senha', 'rules' => 'required|matches[senha]']

			]);

		if($valida){
			$model = new UsuarioModel();
			$model->alteraSenha($email,$senha);
			$model = new ChaveModel();
			$model->excluir($email);

			return redirect()->to(base_url('Login'));
		}	

	}

	private function gerarChave($email){
		$model = new ChaveModel();

		$chave = md5(uniqid(rand(), true));

		$model->save([
			'chave' => $chave,
			'email' => $email]);

		return $chave;

	}
	
}
