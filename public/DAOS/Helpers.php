<?php
namespace DAOS;

use DateTime;
use ConexaoDAO;

class Helpers
{
    private $conexao = new ConexaoDao();
    public function Inserir($campos, $dados, $tabela)
    {
        $query = "INSERT INTO " . $tabela . " (" . $campos . ") VALUES (" . $dados . ")";
    }

    public function Listar($campos, $tabela, $where = null)
    {
        $query = "SELECT " . $campos . " FROM " . $tabela . $where;
    }

    public function Alterar($campos, $dados, $tabela, $where)
    {
        $query = "UPDATE ";
    }

    public function Excluir($tabela, $where)
    {
        $query = "DELETE ";
    }

    public function calcularIdadeFilme($dataLancamento)
    {
        $dataLancamento = new DateTime($dataLancamento);
        $hoje = new DateTime();
        $intervalo = $dataLancamento->diff($hoje);
        return "{$intervalo->y} anos, {$intervalo->m} meses, {$intervalo->d} dias";
    }

}
?>