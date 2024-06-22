<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/VacinaDAO.php';

if (isset($_POST['btnGravar'])) {

    $vacina = trim($_POST['nome_vacina']);
    $data_aplicacao = trim($_POST['data_aplicacao']);
    $fornecedor = trim($_POST['fornecedor']);
    $lote = trim($_POST['lote']);

    $objdao = new VacinaDAO();

    $ret = $objdao->CadastrarVacina($vacina, $data_aplicacao, $fornecedor, $lote);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '_head.php' ?>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <?php include_once '_topo.php' ?>

                <!-- Page Heading -->
                <div class="page-heading">
                    <div class="container-fluid">
                        <div class="row">
                            <?php include_once '_msg.php' ?>
                            <div class="col-md-12">
                                <h1>Cadastrar Vacina</h1>
                                <p>Aqui você poderá cadastrar as vacinas já tomadas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr><br>

                <form action="cadastrar_vacina.php" method="post">
                    <h4 style="color: red">Nome da Vacina*</h4>
                    <fieldset>
                        <input name="nome_vacina" type="text" class="form-control" id="name" placeholder="Digite aqui o nome da vacina">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Data da Aplicação*</h4>
                    <fieldset>
                        <input name="data_aplicacao" type="date" class="form-control" id="name">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Fornecedor</h4>
                    <fieldset>
                        <input name="fornecedor" type="text" class="form-control" id="name" placeholder="Digite aqui a empresa que forneceu a vacina">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Lote</h4>
                    <fieldset>
                        <input name="lote" type="text" class="form-control" id="name" placeholder="Digite aqui o lote da vacina">
                    </fieldset>

                    <br>

                    <button name="btnGravar" class="btn btn-success btn-md" style="background-color: #32CD32; color: white; border-color: #32CD32; width: 90px;">Salvar</button>
                </form>

                <br><br>

            </div>

        </div>

        <!-- Sidebar -->
        <?php include_once '_menu.php' ?>
    </div>

    <!-- Footer -->
    <?php include_once '_rodape.php' ?>


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>