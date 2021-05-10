<?php 
namespace App\Controllers\Ajax;
use App\Controllers\BaseController;
use App\Models\CadastroModel;


class Cadastros extends BaseController{

	public function lista($idcategoria = false){

		$model = new CadastroModel();

		if($idcategoria){
			$cadastros = $model->getCadastro(false,$idcategoria);
		}else{
			$cadastros = $model->getCadastro();
		}

		foreach($cadastros as $cad){

			$result[] = [
				"<a href='/Cadastro/visualiza/".$cad['idcadastro']."/".$cad['idcategoria']."'>".$cad['nome']."</a>",
				$cad['cidade'],
				$cad['descricao']
			];
		}

		$cadastros  = ['data' => $result];
		
		echo json_encode($cadastros, JSON_UNESCAPED_UNICODE);
	}

}