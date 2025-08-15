<?php
namespace DAOS;

use PDO;
use PDOException;
use DateTime;

class Helpers
{
    private $conexao;
    public function __construct()
    {
        $this->conexao = (new ConexaoDAO())->Conexao();
    }
    public function Inserir($campos, $dados, $tabela)
    {
        try {
            $query = "INSERT INTO " . $tabela . " (" . $campos . ") VALUES (" . $dados . ")";

            $statement = $this->conexao->prepare($query);
            if ($statement->execute())
                return 'Salvo com sucesso!';
        } catch (PDOException $e) {
            return "Erro ao inserir: " . $e->getMessage();
        }
    }

    public function Listar($campos, $tabela, $where = null)
    {
        try {
            $query = "SELECT " . $campos . " FROM " . $tabela . $where;

            $statement = $this->conexao->prepare($query);
            if ($statement->execute())
                $Lista = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $Lista;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function Alterar($campos, $tabela, $where)
    {
        try {
            $query = "UPDATE " . $tabela . " SET " . $campos . " " . $where;

            $statement = $this->conexao->prepare($query);
            if ($statement->execute())
                return 'Alterado com sucesso!';
        } catch (PDOException $e) {
            return "Erro ao alterar: " . $e->getMessage();
        }
    }

    public function Excluir($tabela, $where)
    {
        try {
            $query = "DELETE FROM " . $tabela . " " . $where;

            $statement = $this->conexao->prepare($query);
            if ($statement->execute())
                return 'Excluído com sucesso!';
        } catch (PDOException $e) {
            return "Erro ao excluir: " . $e->getMessage();
        }
    }

    public function ExisteFilme($id, $tabela)
    {
        try {
            $stmt = $this->conexao->prepare("SELECT COUNT(*) as total FROM " . $tabela . " WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado['total'] > 0; // Retorna true se existir, false se não
        } catch (PDOException $e) {
            return false;
        }
    }

    public function CalcularIdadeFilme($dataLancamento)
    {
        $dataLancamento = new DateTime($dataLancamento);
        $hoje = new DateTime();
        $intervalo = $dataLancamento->diff($hoje);
        return "{$intervalo->y} anos, {$intervalo->m} meses, {$intervalo->d} dias";
    }

    public function SalvarLog($solicitacao, $rota, $status)
    {
        try {
            $stmt = $this->conexao->prepare(
                "INSERT INTO log_api (solicitacao, rota, status) VALUES (:sol, :rota, :status)"
            );
            $stmt->execute([
                ':sol' => $solicitacao,
                ':rota' => $rota,
                ':status' => $status
            ]);
        } catch (PDOException $e) {
            // Pode gravar erro em arquivo se o log falhar
        }
    }
}