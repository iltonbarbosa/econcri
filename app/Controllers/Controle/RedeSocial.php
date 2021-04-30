<?php 
namespace App\Controllers\Controle;
use App\Controllers\BaseController;
use App\Models\RedeSocialModel;

class RedeSocial extends BaseController{

	var $model = null;

	public function __construct(){
		$this->model = new RedeSocialModel();
	}

	public function index($idcadastro){

		if(!isset($idcadastro))
			return redirect()->to(base_url('controle/cadastro'));

		$this->exibeView($idcadastro);
	}

	public function editar($id = null) {

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['descricao'] = session()->get('categoriadesc');

		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Rede Social - editar";
		$data['cadastro'] =$this->model->getRedeSocial($id);
		$data['cadastros'] =$this->model->getRedesSociais($data['cadastro']['idcadastro']);
		$data['msg'] = null;

		if(empty($data['cadastro']))
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Registro não encontrado!');

		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/redesocial');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function gravar(){

		$idredesocial = $this->request->getVar('idredesocial');
		$idcadastro = $this->request->getVar('idcadastro');
		$nome = $this->request->getVar('nome');
		$link = $this->request->getVar('link');

		helper('form');

		if($idredesocial === null)
			$valida = $this->validate([
			'link' => ['label' => 'Link', 'rules' => 'required|min_length[3]|is_unique[redesocial.link]'],
			]);
		else{
			$valida = $this->validate([
			'link' => ['label' => 'Link', 'rules' => 'required|min_length[3]'],
			]);	
			if($valida &&$this->model-> existeRedeSocial($idredesocial, $link))
				$msg = "Esse link já existe no sistema em outro registro";
		}	

		if($valida){

				$this->model->save([
					'idredesocial' => $idredesocial,
					'idcadastro' => $idcadastro,
					'nome' => $nome,
					'link' => $link
				]);

				$msg = 'Rede Social cadastrada!';
				return redirect()->to(base_url('controle/redesocial/index/'.$idcadastro));

			}else {
				$msg = 'Erro ao cadastrar rede social!';
				$this->exibeView($idcadastro,$msg);
			}

			
	}


	public function excluir($id,$idcadastro){

		$this->model->delete(['idredesocial' => $id]);

		return redirect()->to(base_url('controle/redesocial/index/'.$idcadastro));
	}

	 private function exibeView($idcadastro, $msg = null){

		$model = new RedeSocialModel();

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['descricao'] = session()->get('categoriadesc');

		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Rede Social - ".$data['descricao'];
		$data['idcadastro'] = $idcadastro;
		$data['cadastros'] =$this->model->getRedesSociais($idcadastro);
		$data['msg'] = $msg;
			 
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/redesocial');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	 }

}
