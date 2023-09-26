<?php

namespace API\Model;

use API\DAO\ContaDAO;
use API\Model\CorrentistaModel;

class ContaModel extends Model
{
	public $id, $tipo, $saldo, $limite, $id_correntista;
	public $rows_contas;

	public function save()
	{
		$dao = new ContaDAO();
		if ($this->id == null)
			$dao->insert($this);
		else
			$dao->update($this);
	}

	public function getAllRows()
	{
		$dao = new ContaDAO();

		$this->rows = $dao->select();
	}

	public function delete(int $id)
	{
		$dao = new ContaDAO();

		$dao->delete($id);
	}

	public function getById(int $id)
	{
		$dao = new ContaDAO();

		return $this->rows = $dao->selectById($id);
	}

	public function getPoupancaById(int $id)
	{
		$dao = new ContaDAO();

		return $this->rows = $dao->selectPoupancaById($id);
	}

	public function getCorrenteById(int $id)
	{
		$dao = new ContaDAO();

		return $this->rows = $dao->selectCorrenteById($id);
	}
}
