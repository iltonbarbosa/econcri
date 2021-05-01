<?php namespace App\Controllers;
use App\Models\CategoriaModel;
use App\Models\CadastroModel;

class Home extends BaseController
{
	public function index($idcategoria = false)	{

		$model = new CategoriaModel();
		$modelCad = new CadastroModel();
		if($idcategoria){
			$coordenadas = $modelCad->getCoordenadasByCategoria($idcategoria);
			$cadastro = $modelCad->getCadastro(false,$idcategoria);
			$data['idcategoria'] = $idcategoria;
		}else{	
			$coordenadas = $modelCad->getCoordenadas();
			$cadastro = $modelCad->getCadastro();
		}	
		$data['cadastro'] = $cadastro;
		$data['coordenadas'] = $coordenadas;
		$data['title'] = "Página inicial";
		$data['categorias'] = $model->getCategoria();
		$data['headerMapa'] = "
			<script src='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js'></script>
			<link href='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css' rel='stylesheet' />";
			 
		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('index');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}

	public function listacadastro($idcategoria = false){

		$modelCad = new CadastroModel();

		if($idcategoria){
			$cadastro = $modelCad->getCadastro(false,$idcategoria);
		}else{
			$cadastro = $modelCad->getCadastro();	
		}	

		$data['cadastros'] = $cadastro;
		$data['title'] = "Lista de cadastros";
		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/listacadastro');
		echo view('/templates/footer');
		echo view('/templates/html-footer');

	}

}
