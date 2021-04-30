<?php 
namespace App\Controllers\Controle;
use App\Controllers\BaseController;
use App\Models\CadastroModel;
use App\Models\EmpresaModel;
use App\Models\BandaModel;
use App\Models\CantorModel;

class Cadastro extends BaseController{

	var $model = null;

	public function __construct(){
		$this->model = new CadastroModel();
	}

	public function index()	{

		$data['title'] = "Cadastro";
		$data['subtitulo'] = session()->get('categoriadesc')." - Dados iniciais";
		$data['idcategoria'] = session()->get('idcategoria');
		$data['msg'] = "";
			 
		$this->exibeView($data);
	}

	public function gravar(){

		$idcategoria = session()->get('idcategoria');
		if($idcategoria == null)
		   $idcategoria = $this->request->getVar('idcategoria');

		$idcadastro = $this->request->getVar('idcadastro');
		$idusuario = session()->get('idusuario');
		$nome = $this->request->getVar('nome');
		$cidade = $this->request->getVar('cidade');
		$tempo_atuacao = $this->request->getVar('tempo_atuacao');
		$nome_contato = $this->request->getVar('nome_contato');
		$telefone_contato = $this->request->getVar('telefone_contato');
		$email_contato = $this->request->getVar('email_contato');

		helper('form');

		$valida = $this->validate([
			'nome' => ['label' => 'Nome', 'rules' => 'required|min_length[3]'],
			'cidade' => ['label' => 'Cidade', 'rules' => 'required|min_length[5]'],
			'tempo_atuacao' => ['label' => 'Tempo de atuação', 'rules' => 'required'],
			'nome_contato' => ['label' => 'Nome de contato', 'rules' => 'required|min_length[3]'],
			'telefone_contato' => ['label' => 'Telefone do contato', 'rules' => 'required|min_length[3]'],
			'email_contato' => ['label' => 'E-mail do contato', 'rules' => 'required|min_length[3]'],
			]);

		if($valida && $idcadastro != null){
			if($this->model-> existeCadastro($idcadastro, $nome, $idcategoria))
				$msg = "Estes dados de cadastro já existem no sistema em outro registro";
		}

		if($valida){

			$data = [
				'idcadastro' =>$idcadastro,
				'idusuario' =>$idusuario,
				'idcategoria' =>$idcategoria,
				'nome' => $nome,
				'cidade' => $cidade,
				'tempo_atuacao' => $tempo_atuacao,
				'nome_contato' => $nome_contato,
				'telefone_contato' => $telefone_contato,
				'email_contato' => $email_contato
			];  

			$this->model->save($data);
			$idcadastro = $this->model->getLastInsertID($nome, $idcategoria, $cidade);

			switch ($idcategoria) {
				case '2':
					$this->cadastraEmpresa($idcadastro);
					break;
				case '5':
					$this->cadastraCantor($idcadastro);
					break;
				case '8':
					$this->cadastraBanda($idcadastro);
					break;
			}

			$msg = 'Dados gravados com sucesso!';
			return redirect()->to(base_url('controle/redesocial/index/'.$idcadastro));

		}else {
			$msg = 'Erro ao cadastrar usuári@!';
			$this->exibeView($data, $msg);
		}
	}

	public function editar ($idcadastro, $idcategoria){

		$data['title'] = "Cadastro";
		
		$data['cadastro'] = $this->model->getCadastro($idcadastro, $idcategoria);
		session()->set('idcadastro', $data['cadastro']['idcadastro']);
		session()->set('idcategoria', $data['cadastro']['idcategoria']);
		session()->set('categoriadesc', $data['cadastro']['descricao']);
		$data['idcategoria'] = session()->get('idcategoria');
		$data['subtitulo'] = "Editar - Dados iniciais - ".$data['cadastro']['descricao'];
		$data['msg'] = "";
			 
		$this->exibeView($data);

	}

	public function listar ($idusuario = false){

		$data['title'] = "Cadastro";
		if($idusuario != false)
			$data['cadastros'] = $this->model->getCadastro($idusuario);
		else	
			$data['cadastros'] = $this->model->getCadastro();

		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/listacadastro');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');	

	}

	public function excluir($id = null){

		if($id)
			$this->model->delete(['idcadastro' => $id]);

		return redirect()->to(base_url('controle/cadastro/listar'));
	}

//----------- privates ---------------------

	private function exibeView($data, $msg = null){
		$data['msg'] = $msg;
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/cadastro');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	private function cadastraBanda($idcadastro){

		$num_integrantes = $this->request->getVar('num_integrantes');
		$nome_integrantes = $this->request->getVar('nome_integrantes');
		$idbanda = $this->request->getVar('idbanda');
		$estilo = $this->request->getVar('estilo');
		$autoral_cover = $this->request->getVar('autoral_cover');

		$data = [
			'idbanda' =>$idbanda,
			'idcadastro' =>$idcadastro,
			'estilo' => $estilo,
			'autoral_cover' => $autoral_cover,
			'num_integrantes' => $num_integrantes,
			'nome_integrantes' => $nome_integrantes
		];

		$model = new BandaModel();
		$model->save($data);
	}

	private function cadastraCantor($idcadastro){
		$idcantor = $this->request->getVar('idcantor');
		$estilo = $this->request->getVar('estilo');
		$autoral_cover = $this->request->getVar('autoral_cover');

		$data = [
			'idcantor' =>$idcantor,
			'idcadastro' =>$idcadastro,
			'estilo' => $estilo,
			'autoral_cover' => $autoral_cover,
		];

		$model = new CantorModel();
		$model->save($data);
	}

	private function cadastraEmpresa($idcadastro){
		$idempresa = $this->request->getVar('idempresa');
		$cnpj = $this->request->getVar('cnpj');

		$data = [
			'idempresa' =>$idempresa,
			'idcadastro' =>$idcadastro,
			'cnpj' => $cnpj
		];

		$model = new EmpresaModel();
		$model->save($data);

	}

	public function gravarCordenadas(){
		$idcadastro = session()->get('idcadastro');
		$longitude = $this->request->getVar('longitude');
		$latitude = $this->request->getVar('latitude');

		$this->model->gravaCoordenadas($idcadastro, $latitude, $longitude);

		return redirect()->to(base_url('controle/mapaForm/'));

	}

}
