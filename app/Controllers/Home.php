<?php namespace App\Controllers;
use App\Models\CategoriaModel;
use App\Models\CadastroModel;

class Home extends BaseController{

	var $modelCat = null;
	var $modelCad = null;


	public function __construct(){
		$this->modelCat = new CategoriaModel();
		$this->modelCad = new CadastroModel();
	}

	public function index($idcategoria = false)	{

		if($idcategoria){
			$coordenadas = $this->modelCad->getCoordenadasByCategoria($idcategoria);
			//$cadastro = $this->modelCad->getCadastro(false,$idcategoria);
			$data['idcategoria'] = $idcategoria;
		}else{	
			$coordenadas = $this->modelCad->getCoordenadas();
			$cadastro = $this->modelCad->getCadastro();
		}	
		//$data['cadastro'] = $cadastro;
		$data['coordenadas'] = $coordenadas;
		$data['title'] = "Página inicial";
		$data['categorias'] = $this->modelCat->getCategoria();
		$data['headerMapa'] = "
			<script src='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js'></script>
			<link href='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css' rel='stylesheet' />";
			 
		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('index');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}

	

}
