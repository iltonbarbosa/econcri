<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendaModel;
use App\Models\CategoriaModel;

class Agenda extends BaseController{

	var $model = null;
	var $modelCat = null;

	public function __construct(){
		$this->model = new AgendaModel();
		$this->modelCat = new CategoriaModel();
	}

	public function lista($idcadastro) {

		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Agenda - ".session()->get('categoriadesc');

		$data['cadastros'] =$this->model->getAgendas($idcadastro);
		$data['idcadastro'] = $idcadastro;
		$data['idcategoria'] = session()->get('idcategoria');
		$data['categorias'] = $this->modelCat->getCategoria();

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/agenda');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}


}