<?php

namespace API\Model;

use API\DAO\CorrentistaDAO;
use API\DAO\ContaDAO;

class CorrentistaModel extends Model {
	public $id, $nome, $cpf, $data_nasc, $senha;
	public $rows_contas;

	public function save()
	{
		$dao_correntista = new CorrentistaDAO();
        
        $model_App = $dao_correntista->save($this);

		// Se o insert do correntista deu certo
        // vamos inserir sua conta corrente
        if($model_App->id != null)
        {
            $dao_conta = new ContaDAO();

            // Abrindo a conta corrente
            $conta_corrente = new ContaModel();
            $conta_corrente->id_correntista = $model_App->id;
            $conta_corrente->saldo = 10;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_App->rows_contas[] = $conta_corrente;
		}
		return $model_App;
	}

	public function CriarPoupanca(int $id)
	{
		$c = $this;

		$dao_conta = new ContaDAO();

		$conta_poupanca = new ContaModel();
		$conta_poupanca->id_correntista = $id;
		$conta_poupanca->saldo = 10;
		$conta_poupanca->limite = 0;
		$conta_poupanca->tipo = 'P';
		$conta_poupanca = $dao_conta->insert($conta_poupanca);

		$c->rows_contas[] = $conta_poupanca;
		return $c;
	}

	public function getByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {      		
        return (new CorrentistaDAO())->selectByCpfAndSenha($cpf, $senha);
    }

	public function getAllRows() 
	{
		$dao = new CorrentistaDAO();

		$this->rows = $dao->select();
	}

	public function delete(int $id) 
	{
		$dao = new CorrentistaDAO();
		
		$dao->delete($id);
	}

	public function getById(int $id) 
	{
		$dao = new CorrentistaDAO();

		$this->rows = $dao->selectById($id);
	}
}