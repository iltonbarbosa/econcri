<?php 
namespace App\Controllers\Controle;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class OqueCadastrar extends BaseController
{
	public function index()	{

		$model = new CategoriaModel();

		$data['title'] = "Cadastro";
		$data['categorias'] = $model->getCategoria();
			 
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/oquecadastrar');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function gravar(){
		$categoria = $this->request->getVar('categoria');

		$c = explode("--",$categoria);
		$idcategoria = $c[0];
		$categoriadesc = $c[1];

		session()->set('idcategoria', $idcategoria);
		session()->set('categoriadesc', $categoriadesc);

		return redirect()->to(base_url('controle/Cadastro'));
	}

}
