<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\RedeSocialModel;
use App\Models\CategoriaModel;

class RedeSocial extends BaseController{

	var $model = null;
	var $modelCat = null;

	public function __construct(){
		$this->model = new RedeSocialModel();
		$this->modelCat = new CategoriaModel();
	}

	public function lista($idcadastro) {

		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Rede Social - ".session()->get('categoriadesc');

		$data['cadastros'] =$this->model->getRedesSociais($idcadastro);
		$data['idcadastro'] = $idcadastro;
		$data['idcategoria'] = session()->get('idcategoria');
		$data['categorias'] = $this->modelCat->getCategoria();

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/redesocial');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}


}