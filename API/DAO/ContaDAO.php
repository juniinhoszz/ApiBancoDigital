<?php
namespace API\DAO;

use API\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function insert(ContaModel $model)
    {
        $sql = "INSERT INTO conta (tipo, saldo, limite, id_correntista) VALUES (?, ?, ?, ?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->id_correntista);
        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function search(string $busca) : array
    {
        $str_busca = ['filtro' => '%' . $busca . '%'];

        $sql = "SELECT c.*,
        co.nome as nome_correntista
        FROM Conta c
        JOIN Correntista co ON co.id = c.id_correntista
        WHERE co.nome LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_busca);

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ContaModel");
    }

    public function update(ContaModel $model)
    {
        $sql = "UPDATE conta SET tipo=?, saldo=?, limite = ?, id_correntista = ? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->id_correntista);
        $stmt->bindValue(5, $model->id);
        $stmt->execute();

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT c.*,
        co.nome as nome_correntista
        FROM Conta c
        JOIN Correntista co ON co.id = c.id_correntista
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "API\Model\ContaModel");
    }

    public function selectContaByTipoeId(int $id, string $tipo)
    {
        $sql = "SELECT c.* /*,
        co.nome as nome_correntista */
        FROM Conta c
     /* JOIN Correntista co ON co.id = c.id_correntista */
        WHERE c.id_correntista = ?,
        WHERE c.tipo = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $tipo);
        $stmt->execute();

        $obj = $stmt->fetchObject("API\Model\ContaModel");

        return is_object($obj) ? $obj : new ContaModel();
    }

    public function selectById(int $id)
    {
        $sql = "SELECT c.* /*,
        co.nome as nome_correntista */
        FROM Conta c
     /* JOIN Correntista co ON co.id = c.id_correntista */
        WHERE c.id_correntista = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $obj = $stmt->fetchObject("API\Model\ContaModel");

        return is_object($obj) ? $obj : new ContaModel();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM conta WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}