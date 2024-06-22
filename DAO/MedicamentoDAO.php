<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class MedicamentoDAO extends Conexao
{

    public function CadastrarMedicamento($nome_medicamento, $dosagem, $categoria)
    {

        if (trim($nome_medicamento) == '' || trim($dosagem) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'insert into tb_medicamento
        (nome_medicamento, dosagem_medicamento, categoria_medicamento, id_usuario)
        values
        (?, ?, ?, ?);';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome_medicamento);
        $sql->bindValue(2, $dosagem);
        $sql->bindValue(3, $categoria);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarMedicamento()
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_medicamento,
                               nome_medicamento,
                               dosagem_medicamento,
                               categoria_medicamento
                        FROM tb_medicamento
                        WHERE id_usuario = ?';

        $comando_sql .= ' ORDER BY nome_medicamento';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharMedicamento($idMedicamento)
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_medicamento,
                               nome_medicamento,
                               dosagem_medicamento,
                               categoria_medicamento
                        FROM tb_medicamento
                        WHERE id_medicamento = ?
                        AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idMedicamento);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarMedicamento($idMedicamento, $nome_medicamento, $dosagem, $categoria)
    {

        if (trim($nome_medicamento) == '' || $idMedicamento == '' || trim($dosagem) == '') {
            return 0;   
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_medicamento
                           SET nome_medicamento = ?,
                               dosagem_medicamento = ?,
                               categoria_medicamento = ?
                         WHERE id_medicamento = ?
                           AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome_medicamento);
        $sql->bindValue(2, $dosagem);
        $sql->bindValue(3, $categoria);
        $sql->bindValue(4, $idMedicamento);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();

            return -1;
        }
    }

    public function ExcluirMedicamento($idMedicamento)
    {

        if ($idMedicamento == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE
                        FROM tb_medicamento
                        WHERE id_medicamento = ?
                        AND id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idMedicamento);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            return -4;
        }
    }
}
