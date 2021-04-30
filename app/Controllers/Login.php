<?php 
namespace App\Controllers; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\UserModel;

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
		$model = new UserModel();

		$email = $this->request->getVar('email');
		$senha = $this->request->getVar('senha');
		$cancelar = $this->request->getVar('cancelar');

		if($cancelar !== null)
		return redirect()->to(base_url('/'));

		$data['usuario'] = $model->verificaUsuario($email, $senha);

		if(empty($data['usuario'])){
			return redirect()->to(base_url('login'));
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

}
