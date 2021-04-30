<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categorias extends BaseController{

	var $model = null;

	public function __construct(){
		$this->model = new CategoriaModel();
	}

	public function index()	{
		
		$data = [
			'title' => 'Categorias',
			'subtitulo' => 'Inserir',
			'categorias' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'msg' => ''
		];

		$this->exibeView($data);
	}

	public function editar($id = null) {
		
		$data = [
			'title' => 'Categorias',
			'subtitulo' => 'Editar',
			'categoria' => $this->model->getCategoria($id),
			'categorias' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'msg' => ''
		];

		if(empty($data['categoria']))
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Não foi encontrada a categoria');

		$this->exibeView($data);
	}

	public function gravar(){

		$id = $this->request->getVar('id');
		$descricao = $this->request->getVar('descricao');

		helper('form');

		if($id === null)
			$valida = $this->validate([
			'descricao' => ['label' => 'Descrição', 'rules' => 'required|min_length[3]|is_unique[categoria.descricao]'],
			]);
		else{
			$valida = $this->validate([
			'descricao' => ['label' => 'Descrição', 'rules' => 'required|min_length[3]'],
			]);	
			if($valida && $this->model-> existeCategoria($id, $descricao))
				$msg = "Essa categoria já existe no sistema em outro registro";
		}	

		if($valida){

				$this->model->save([
					'idcategoria' => $id,
					'descricao' => $descricao
				]);

				$msg = 'Categoria cadastrada!';

			}else {
				$msg = 'Erro ao cadastrar categoria!';
			}

			$data = [
				'title' => 'Categorias',
				'subtitulo' => 'Inserir',
				'categorias' => $this->model->paginate(10),
				'pager' => $this->model->pager,
				'msg' => $msg
			];

			$this->exibeView($data);
	}


	public function excluir($id = null){

		$this->model->delete(['idcategoria' => $id]);

		return redirect()->to(base_url('controle/categorias'));
	}

	private function exibeView($data){
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/categorias');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

}
