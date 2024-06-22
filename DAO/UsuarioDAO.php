<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao
{

    public function CarregarMeusDados()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select nome_usuario, data_nascimento, email_usuario, tipo_sanguineo, telefone_usuario
                        from tb_usuario
                        where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $data_nasc, $tipo_sangue, $email, $telefone)
    {

        if (trim($nome) == '' || trim($data_nasc) == '' || trim($tipo_sangue) == '' || trim($email) == ''){
            return 0;
        }

        if($this->VerificarEmailDuplicadoAlteracao($email) != 0){
            return -6;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'update tb_usuario
                            set nome_usuario = ?,
                                data_nascimento = ?,
                                email_usuario = ?,
                                tipo_sanguineo = ?,
                                telefone_usuario = ?
                        where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $data_nasc);
        $sql->bindValue(3, $email);
        $sql->bindValue(4, $tipo_sangue);
        $sql->bindValue(5, $telefone);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }


    public function ValidarLogin($email, $senha)
    {

        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT id_usuario,
                               nome_usuario  
                          FROM tb_usuario
                         WHERE email_usuario = ? 
                           AND senha_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();

        $user = $sql->fetchAll();

        if(count($user) == 0){
            return -7;
        }

        $cod = $user[0]['id_usuario'];
        $nome = $user[0]['nome_usuario'];
        UtilDAO::CriarSessao($cod, $nome);
        header('location: inicial.php');
        exit;

    }     
                           
    public function VerificarEmailDuplicadoCadastro($email){
        if(trim($email) == '')
        return 0;

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT COUNT(email_usuario) as contar 
                          FROM tb_usuario 
                         WHERE email_usuario = ?'; 

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1, $email);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar']; 
    }

    public function VerificarEmailDuplicadoAlteracao($email){
        if(trim($email) == '')
        return 0;

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT COUNT(email_usuario) as contar 
                          FROM tb_usuario 
                         WHERE email_usuario = ? 
                           AND id_usuario != ?'; 

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar']; 
    }

    public function CadastrarMeusDados($nome, $data_nasc, $tipo_sangue, $email, $senha, $repsenha, $telefone)
    {

        if (trim($nome) == '' || trim($data_nasc) == '' || trim($tipo_sangue) == '' || trim($email) == '' || trim($senha) == '' || trim($repsenha) == '')
            return 0;

        if (strlen($nome) < 3)
            return -2;

        if (strlen($senha) < 6)
            return -3;

        if (trim($senha) != trim($repsenha))
            return -4;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return -9;
        }

        if($this->VerificarEmailDuplicadoCadastro($email) != 0){
            return -6;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'INSERT INTO tb_usuario
                                    (nome_usuario, data_nascimento, email_usuario, tipo_sanguineo, senha_usuario, data_cadastro, telefone_usuario)
                                    VALUES
                                    (?, ?, ?, ?, ?, ?, ?)'; 
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $data_nasc);
        $sql->bindValue(3, $email);
        $sql->bindValue(4, $tipo_sangue);
        $sql->bindValue(5, $senha);
        $sql->bindValue(6, date('Y-m-d'));
        $sql->bindValue(7, $telefone);

        try
        {
            $sql->execute();
            
            return 1;
        }
        catch(Exception $ex) 
        {
            echo $ex->getMessage();

            return -1;
        }

    }
}

