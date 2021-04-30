<?php namespace App\Controllers;
use App\Models\CategoriaModel;

class Home extends BaseController
{
	public function index()	{

		$model = new CategoriaModel();

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

	//--------------------------------------------------------------------

}
