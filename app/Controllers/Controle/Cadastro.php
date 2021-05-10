<?php 
namespace App\Controllers\Controle;
use App\Controllers\BaseController;
use App\Models\CadastroModel;
use App\Models\EmpresaModel;
use App\Models\BandaModel;
use App\Models\CantorModel;
use App\Models\UsuarioModel;

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
		$nome = str_replace("'","’",$this->request->getVar('nome'));
		$cidade = str_replace("'","’",$this->request->getVar('cidade'));
		$tempo_atuacao = $this->request->getVar('tempo_atuacao');
		$nome_contato = str_replace("'","’",$this->request->getVar('nome_contato'));
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

		session()->set('cadastro', $data);	

		if($valida && $idcadastro != null){
			if($this->model-> existeCadastro($idcadastro, $nome, $idcategoria))
				$msg = "Estes dados de cadastro já existem no sistema em outro registro";
		}

		if($valida){

			$this->model->save($data);
			$idcadastro = $this->model->getLastInsertID($nome, $idcategoria, $cidade);

			session()->set('idcadastro', $idcadastro);
			session()->set('idcategoria', $idcategoria);

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
			session()->set('cadastro', null);	
			return redirect()->to(base_url('/controle/RedeSocial/index/'.$idcadastro));

		}else {
			$msg = 'Erro ao cadastrar usuári@!';
			$this->exibeView($data, $msg);
		}
	}

	public function editar ($idcadastro, $idcategoria){

		$userModel = new UsuarioModel();

		$data['title'] = "Cadastro";
		
		$data['cadastro'] = $this->model->getCadastro($idcadastro, $idcategoria);

		session()->set('idcadastro', $data['cadastro']['idcadastro']);
		session()->set('idcategoria', $idcategoria);

		$data['idcategoria'] = $idcategoria;
		$data['cadastrado_por'] = $userModel->getUsuario($data['cadastro']['idusuario']);
		$data['subtitulo'] = "Editar - Dados iniciais - ".$data['cadastro']['descricao'];
		$data['msg'] = "";
			 
		$this->exibeView($data);

	}

	public function listar (){

		$idusuario = session()->get('idusuario');
		$perfil = session()->get('perfil');

		$data['title'] = "Cadastro";
		if($perfil != 1)
			$data['cadastros'] = $this->model->getCadastroByUsuario($idusuario);
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
			$this->model->delete(['idcadastro' => $id]);//Utilizando recurso que não chega a deletar do banco

		return redirect()->to(base_url('controle/Cadastro/listar'));
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

		return redirect()->to(base_url('controle'));//tela inicial autenticado

	}

}
