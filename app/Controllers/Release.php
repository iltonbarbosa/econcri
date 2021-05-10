<?php 
namespace App\Controllers; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\ReleaseModel;
use App\Models\LinkVideoModel;
use App\Models\CategoriaModel;

class Release extends BaseController{

	var $model = null;
	var $linkVModel = null;
	var $modelCat = null;

	public function __construct(){
		$this->model = new ReleaseModel();
		$this->linkVModel = new LinkVideoModel();
		$this->modelCat = new CategoriaModel();
	}

	public function index(){

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['categorias'] = $this->modelCat->getCategoria();

		$this->exibeView($data);
	}


	private function exibeView($data){

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['descricao'] = session()->get('categoriadesc');
		$data['title'] = 'Release';
		$data['subtitulo'] = 'Visualiza -'.$data['descricao'];
		$data['cadastro'] = $this->model->getRelease($data['idcadastro']);
		$data['linkVideos'] = $this->linkVModel->getLinkVideos($data['idcadastro']);

		echo view('/templates/html-header', $data);
		echo view('/templates/header');
		echo view('/pages/release');
		echo view('/templates/footer');
		echo view('/templates/html-footer');
	}

	

}
