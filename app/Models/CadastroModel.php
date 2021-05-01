<?php
namespace App\Models;
use CodeIgniter\Model;

class CadastroModel extends Model{

	protected $table = 'cadastro';
	protected $allowedFields = ['idcadastro','idcategoria', 'idusuario','nome', 'estilo','autoral_cover','cidade',
								'tempo_atuacao','num_integrantes','nome_integrantes','nome_contato','telefone_contato','email_contato'];
	protected $primaryKey = 'idcadastro';

	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $dateFormat = 'datetime';
	protected $createdField = 'dtcadastro';

	protected $beforeInsert = [
		'gerarId' // this is ben called from the trait
	];

	protected function gerarId(array $data){
		$data['data']['idcadastro'] = md5(uniqid(rand(), true));

		return $data;
	}

	public function getCadastro($idcadastro = false, $idcategoria = false){

		if ($idcadastro == false && $idcategoria != false){
			$query = $this->query("SELECT * FROM cadastro join categoria using(idcategoria) where idcategoria ='".$idcategoria."' order by nome" );
			return $query->getResult('array');
		}else
			if($idcadastro == false || $idcategoria == false){
				$query = $this->query("SELECT * FROM cadastro join categoria using(idcategoria) order by nome" );
				return $query->getResult('array');
			}

		return $this->getCadastrobyId($idcadastro, $idcategoria);			
	}

	public function existeCadastro($id, $nome, $idcategoria){

		$query = $this->query("SELECT * FROM cadastro where nome = '".$nome."' and idcategoria = '".$idcategoria."' and idcadastro != '".$id."'" );

		return $query->getRow();

	}

	public function getLastInsertID($nome, $idcategoria, $cidade){

		$query = $this->query("SELECT idcadastro FROM cadastro where nome = '".$nome."' and idcategoria = '".$idcategoria."' and cidade = '".$cidade."'" );
		$row   = $query->getRow();

		return $row->idcadastro;
	}

	protected function getCadastrobyId($idcadastro, $idcategoria){
		$tabela = '';
		switch ($idcategoria) {
			case '2':
				$tabela = 'empresa';
				break;
			case '5':
				$tabela = 'cantor';
				break;
			case '8':
				$tabela = 'banda';
				break;
		}

		if($tabela)
			return $this->asArray()
				->join($tabela, 'idcadastro')
				->join('categoria', 'idcategoria')
				->where(['cadastro.idcadastro' => $idcadastro])
				->first();

		return $this->asArray()
				->join('categoria', 'idcategoria')
				->where(['cadastro.idcadastro' => $idcadastro])
				->first();		

	}

	public function gravaCoordenadas($idcadastro, $latitude, $longitude){

		$this->query("UPDATE cadastro SET latitude='".$latitude."', longitude ='".$longitude."' where idcadastro = '".$idcadastro."'");

	}

	public function getCoordenadas($idcadastro = false){

		$where = '';

		if($idcadastro)
		  $where = " where idcadastro ='".$idcadastro."'";

		$query = $this->query("SELECT latitude,longitude, nome, idcategoria, nome_contato, email_contato FROM cadastro ".$where);
		return $query->getResult('array');
		
	}

	public function getCoordenadasByCategoria($idcategoria){

		$query = $this->query("SELECT latitude,longitude, nome, idcategoria, nome_contato, email_contato FROM cadastro where idcategoria ='".$idcategoria."'");
		return $query->getResult('array');
		
	}


}