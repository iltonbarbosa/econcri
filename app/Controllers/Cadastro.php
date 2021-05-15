<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\CadastroModel;

class Cadastro extends BaseController{

	var $modelCat = null;
	var $modelCad = null;

	public function __construct(){
		$this->modelCat = new CategoriaModel();
		$this->modelCad = new CadastroModel();
	}

	public function lista($idcategoria = false){

		session()->set('idcadastro', null);
		session()->set('idcategoria', null);
		session()->set('categoriadesc', null);

		$data['title'] = "Lista de cadastros";
		$data['categorias'] = $this->modelCat->getCategoria();
		$data['listaCadastro'] = true;

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/listacadastro');
		echo view('/templates/footer');
		echo view('/templates/html-footer');

	}

	public function locaisPraTocar(){

		$coordenadas = $this->modelCad->getLocaisPraTocar();
		$cadastro = $this->modelCad->getCadastro();
	
		$data['coordenadas'] = $coordenadas;
		$data['title'] = "Página inicial";
		$data['categorias'] = $this->modelCat->getCategoria();
		$data['headerMapa'] = "
			<script src='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js'></script>
			<link href='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css' rel='stylesheet' />";
			
		echo view('/templates/html-header', $data);

		if(session()->get('idusuario')!=null)
			echo view('backend/templates/header');
		else	
			echo view('/templates/header');
		echo view('index');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}

	public function visualiza($idcadastro,$idcategoria){

		$data['categorias'] = $this->modelCat->getCategoria();
		$data['cadastro'] = $this->modelCad->getCadastro($idcadastro,$idcategoria);
		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Dados iniciais - ".$data['cadastro']['descricao'];

		session()->set('idcadastro', $data['cadastro']['idcadastro']);
		session()->set('idcategoria', $data['cadastro']['idcategoria']);
		session()->set('categoriadesc', $data['cadastro']['descricao']);

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/cadastro');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}

	public function buscaPorPalavra(){

		$palavra = $this->request->getVar('palavra');

		helper('form');

		$valida = $this->validate([
			'palavra' => ['label' => 'Palavra', 'rules' => 'required|min_length[4]|max_length[20]'],
			]);	

		$cadastro = $this->modelCad->buscaPorPalavra($palavra);

		$data['cadastros'] = $cadastro;
		$data['title'] = "Lista de cadastros localizados com a palavra ".$palavra;
		$data['categorias'] = $this->modelCat->getCategoria();//para o menu lateral

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/listacadastro');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}

}