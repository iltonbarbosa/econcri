<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\ReleaseModel;
use App\Models\LinkVideoModel;

class Release extends BaseController{

	var $model = null;
	var $linkVModel = null;

	public function __construct(){
		$this->model = new ReleaseModel();
		$this->linkVModel = new LinkVideoModel();
	}

	public function index(){

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');

		$data['msg'] = '';

		if(!isset($data['idcadastro']))
			return redirect()->to(base_url('controle/cadastro'));

		$this->exibeView($data);
	}


	public function gravar(){

		$idrelease = $this->request->getVar('idrelease');
		$idcadastro = $this->request->getVar('idcadastro');
		$release = $this->request->getVar('release');
		$linkportfolio = $this->request->getVar('linkportfolio');
		$palavraschave = $this->request->getVar('palavraschave');

		helper('form');

		$valida = $this->validate([
			'release' => ['label' => 'Release', 'rules' => 'required|min_length[20]'],
			]);

		if($valida){

				$this->model->save([
					'idrelease' => $idrelease,
					'idcadastro' => $idcadastro,
					'release' => $release,
					'linkportfolio' => $linkportfolio,
					'palavraschave' => $palavraschave
				]);

				$msg = 'Release cadastrado com sucesso!';

			}else {
				$msg = 'Erro ao cadastrar release!';
			}

			$data['msg'] = $msg;
			$data['cadastro']['release'] = $release;
			$data['cadastro']['linkportfolio'] = $linkportfolio;

			$this->exibeView($data);
	}


	public function excluir($id = null){

		$this->model->delete(['idcadastro' => $id]);
		
		return redirect()->to(base_url('controle/release'));

	}

	private function exibeView($data){

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['descricao'] = session()->get('categoriadesc');
		$data['title'] = 'Release';
		$data['subtitulo'] = 'Cadastrar -'.$data['descricao'];
		$data['cadastro'] = $this->model->getRelease($data['idcadastro']);
		$data['linkVideos'] = $this->linkVModel->getLinkVideos($data['idcadastro']);
		$data['msg'] = '';

		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/release');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	//----------- link videos ---------------

	public function gravarLink(){

		$idcadastro = $this->request->getVar('idcadastro');
		$link = $this->request->getVar('link');

		helper('form');

		$valida = $this->validate([
			'link' => ['label' => 'Link do vídeo', 'rules' => 'required|min_length[10]|is_unique[linkvideo.link]'],
			]);

		if($valida){

				$this->linkVModel->save([
					'idcadastro' => $idcadastro,
					'link' => $link,
				]);

				$msg = 'Link cadastrado com sucesso!';

			}else {
				$msg = 'Erro ao cadastrar link!';
			}

			$data['msg'] = $msg;

			$this->exibeView($data);

	}


	public function excluirLink($id = null){

		$this->linkVModel->delete(['idcadastro' => $id]);

		return redirect()->to(base_url('controle/release'));
		
	}

}
