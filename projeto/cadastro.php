<?php

require_once '../DAO/UsuarioDAO.php';

if (isset($_POST['btnEnviar'])) {

    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $tipo_sangue = $_POST['tipo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repsenha = $_POST['repsenha'];
    $telefone = $_POST['telefone_contato'];

    $objdao = new UsuarioDAO();

    $ret = $objdao->CadastrarMeusDados($nome, $data_nasc, $tipo_sangue, $email, $senha, $repsenha, $telefone);

    //header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '_head.php' ?>

<body>

    <div class="page-cadastro">
        <div class="card-cadastro">

            <?php include_once '_msg.php' ?>

            <form action="cadastro.php" method="post">
                <h1 class="h1-cadastro">Cadastro</h1>
                <p>Preencha os campos abaixo com seus dados</p>
                <p class="p-cadastro">Dados pessoais:</p>
                <input class="campo-cadastro" type="text" placeholder="Nome Completo" name="nome" />
                <line>
                    <label class="label-data-nasc">Data de Nascimento</label>
                    <input class="date" type="date" placeholder="Data de Nascimento" name="data_nasc" />
                </line>
                <select class="campo-cadastro" name="tipo" id="">
                    <option value="">Selecione o Tipo Sanguíneo</option>
                    <option value="1">A+</option>
                    <option value="2">A-</option>
                    <option value="3">B+</option>
                    <option value="4">B-</option>
                    <option value="5">AB+</option>
                    <option value="6">AB-</option>
                    <option value="7">O+</option>
                    <option value="8">O-</option>
                </select>
                <input class="campo-cadastro" type="email" placeholder="E-mail" name="email" />
                <input class="campo-cadastro" type="password" placeholder="Digite sua senha (mínimo 6 caracteres)" name="senha" />
                <input class="campo-cadastro" type="password" placeholder="Digite a senha novamente" name="repsenha" />
                <input class="campo-cadastro" type="tel" placeholder="Telefone de Contato" name="telefone_contato" />

                <button class="botao-cadastro" name="btnEnviar">Enviar</button>

                <p class="p-login">Já tem uma conta? <a class="a-login" href="login.php">Clique aqui e acesse sua conta!</a></p>
            </form>
        </div>
    </div>
</body>

</html>