<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class VacinaDAO extends Conexao
{

    public function CadastrarVacina($nome_vacina, $data_aplicacao, $fornecedor, $lote)
    {

        if (trim($nome_vacina) == '' || trim($data_aplicacao) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'insert into tb_vacina
        (nome_vacina, data_vacina, fornecedor_vacina, lote_vacina, id_usuario)
        values
        (?, ?, ?, ?, ?);';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome_vacina);
        $sql->bindValue(2, $data_aplicacao);
        $sql->bindValue(3, $fornecedor);
        $sql->bindValue(4, $lote);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarVacina()
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_vacina,
                               nome_vacina,
                               data_vacina,
                               fornecedor_vacina,
                               lote_vacina
                        FROM tb_vacina
                        WHERE id_usuario = ?';

        $comando_sql .= ' ORDER BY nome_vacina';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharVacina($idVacina)
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_vacina,
                               nome_vacina,
                               data_vacina,
                               fornecedor_vacina,
                               lote_vacina
                        FROM tb_vacina
                        WHERE id_vacina = ?
                        AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idVacina);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarVacina($idVacina, $vacina, $data_aplicacao, $fornecedor, $lote)
    {

        if (trim($vacina) == '' || $idVacina == '' || trim($data_aplicacao) == '') {
            return 0;   
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_vacina
                           SET nome_vacina = ?,
                               data_vacina = ?,
                               fornecedor_vacina = ?,
                               lote_vacina = ?
                         WHERE id_vacina = ?
                           AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $vacina);
        $sql->bindValue(2, $data_aplicacao);
        $sql->bindValue(3, $fornecedor);
        $sql->bindValue(4, $lote);
        $sql->bindValue(5, $idVacina);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();

            return -1;
        }
    }

    public function ExcluirVacina($idVacina)
    {

        if ($idVacina == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE
                        FROM tb_vacina
                        WHERE id_vacina = ?
                        AND id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idVacina);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            return -4;
        }
    }
}
