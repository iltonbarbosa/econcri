<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\CadastroModel;

class MapaForm extends BaseController
{
	public function index(){

		$idcadastro = session()->get('idcadastro');
		$model = new CadastroModel();
		$coordenadas = $model->getCoordenadas($idcadastro);

		$data['latitude'] = $coordenadas[0]['latitude'];
		$data['longitude'] = $coordenadas[0]['longitude'];

		$data['title'] = 'Mapa';
		$data['headerMapa'] = "
			<script src='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js'></script>
			<link href='https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css' rel='stylesheet' />";
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/mapaForm');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	//--------------------------------------------------------------------

}
