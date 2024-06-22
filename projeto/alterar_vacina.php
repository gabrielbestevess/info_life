<?php

require_once '../DAO/VacinaDAO.php';

$objdao = new VacinaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idVacina = $_GET['cod'];
    $dados = $objdao->DetalharVacina($idVacina);

    if (count($dados) == 0) {
        header('location: consultar_vacina.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {

    $idVacina = $_POST['cod'];
    $vacina = trim($_POST['nome_vacina']);
    $data_aplicacao = trim($_POST['data_aplicacao']);
    $fornecedor = trim($_POST['fornecedor']);
    $lote = trim($_POST['lote']);

    $ret = $objdao->AlterarVacina($idVacina, $vacina, $data_aplicacao, $fornecedor, $lote);

    header('location: consultar_vacina.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $idVacina = $_POST['cod'];

    $ret = $objdao->ExcluirVacina($idVacina);

    header('location: consultar_vacina.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_vacina.php');
    exit;
}

// echo '<pre>';
// print_r($dados);
// echo '</pre>';

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
                                <h1>Alterar Vacina</h1>
                                <p>Aqui você poderá alterar as vacinas já cadastradas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr><br>

                <form action="alterar_vacina.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_vacina'] ?>">

                    <h4 style="color: red">Nome da Vacina*</h4>
                    <fieldset>
                        <input name="nome_vacina" type="text" class="form-control" id="name" placeholder="Digite aqui o nome da vacina" value="<?= $dados[0]['nome_vacina'] ?>">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Data da Aplicação*</h4>
                    <fieldset>
                        <input name="data_aplicacao" type="date" class="form-control" id="name" value="<?= $dados[0]['data_vacina'] ?>">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Fornecedor</h4>
                    <fieldset>
                        <input name="fornecedor" type="text" class="form-control" id="name" placeholder="Digite aqui a empresa que forneceu a vacina" value="<?= $dados[0]['fornecedor_vacina'] ?>">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Lote</h4>
                    <fieldset>
                        <input name="lote" type="text" class="form-control" id="name" placeholder="Digite aqui o lote da vacina" value="<?= $dados[0]['lote_vacina'] ?>">
                    </fieldset>

                    <br>
                    <div style="display: flex; gap: 10px;">
                        <button name="btnSalvar" type="submit" class="btn btn-success btn-md" style="background-color: #32CD32; color: white; border-color: #32CD32;  width: 90px; display: inline-block;">Salvar</button>
                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modalExcluir" style="width: 90px; display: inline-block;">Excluir</button>
                    </div>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h7 class="modal-title" id="myModalLabel" style="font-weight: bold;">Confirmação de Exclusão</h7>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <b>Deseja excluir a vacina:</b> <?= $dados[0]['nome_vacina'] ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="btnExcluir">Sim</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <br><br>
                </form>

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