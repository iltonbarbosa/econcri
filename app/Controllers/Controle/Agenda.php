<?php 
namespace App\Controllers\Controle;
use App\Controllers\BaseController;
use App\Models\AgendaModel;

class Agenda extends BaseController{

	var $model = null;

	public function __construct(){
		$this->model = new AgendaModel();
	}

	public function index($idcadastro, $msg = null){

		if(!isset($idcadastro))
			return redirect()->to(base_url('controle/Cadastro'));

		$this->exibeView($idcadastro,$msg);
	}

	public function editar($id = null) {

		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['descricao'] = session()->get('categoriadesc');

		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Agenda - editar";
		$data['cadastro'] =$this->model->getAgenda($id);
		$data['cadastros'] =$this->model->getAgendas($data['cadastro']['idcadastro']);
		$data['msg'] = null;

		if(empty($data['cadastro']))
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Registro não encontrado!');

		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/agenda');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function gravar(){

		$idagenda = $this->request->getVar('idagenda');
		$idcadastro = $this->request->getVar('idcadastro');
		$dtagenda = $this->request->getVar('dtagenda');
		$hora = $this->request->getVar('hora');
		$local = $this->request->getVar('local');


		helper('form');

		$valida = $this->validate([
			'dtagenda' => ['label' => 'Data', 'rules' => 'required'],
			]);

		if($idagenda != null && $this->model-> existeAgenda($idagenda, $dtagenda, $hora)){	
			$msg = "Já existe um registro com esta mesma data e hora";
		}	

		if($valida){

				$this->model->save([
					'idagenda' => $idagenda,
					'idcadastro' => $idcadastro,
					'dtagenda' => $dtagenda,
					'hora' => $hora,
					'local' => $local
				]);

				$msg = 'Agenda cadastrada!';
				return redirect()->to(base_url('/controle/Agenda/index/'.$idcadastro));

			}else {
				$msg = 'Erro ao cadastrar dados da agenda!';
				$this->exibeView($idcadastro,$msg);
			}

			
	}


	public function excluir($id,$idcadastro){

		try	{
			$this->model->delete(['idagenda' => $id]);
		}
		catch (\Exception $e)
		{
			echo $e->getMessage();
			$msg = "Erro ao entar excluir data da agenda.";
		}

		return redirect()->to(base_url('/controle/Agenda/index/'.$idcadastro."/".$msg));
	}

	 private function exibeView($idcadastro, $msg = null){
		
		$data['idcadastro'] = session()->get('idcadastro');
		$data['idcategoria'] = session()->get('idcategoria');
		$data['descricao'] = session()->get('categoriadesc');

		$data['title'] = "Cadastro";
		$data['subtitulo'] = "Agenda - ".$data['descricao'];
		$data['idcadastro'] = $idcadastro;
		$data['cadastros'] =$this->model->getAgendas($idcadastro);
		$data['msg'] = $msg;
			 
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/agenda');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	 }

}
