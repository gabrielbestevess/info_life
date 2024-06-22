<?php

require_once '../DAO/MedicamentoDAO.php';

$objdao = new MedicamentoDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idMedicamento = $_GET['cod'];
    $dados = $objdao->DetalharMedicamento($idMedicamento);

    if (count($dados) == 0) {
        header('location: consultar_medicamento.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {

    $idMedicamento = $_POST['cod'];
    $nome_medicamento = trim($_POST['nome_medicamento']);
    $dosagem = trim($_POST['dosagem']);
    $categoria = trim($_POST['categoria']);

    $ret = $objdao->AlterarMedicamento($idMedicamento, $nome_medicamento, $dosagem, $categoria);

    header('location: consultar_medicamento.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $idMedicamento = $_POST['cod'];

    $ret = $objdao->ExcluirMedicamento($idMedicamento);

    header('location: consultar_medicamento.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_medicamento.php');
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
                                <h1>Alterar Medicamento</h1>
                                <p>Aqui você poderá alterar os seus medicamentos cadastrados</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr><br>

                <form action="alterar_medicamento.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_medicamento'] ?>">

                    <h4 style="color: red">Nome do Medicamento*</h4>
                    <fieldset>
                        <input name="nome_medicamento" type="text" class="form-control" id="name" placeholder="Digite aqui o nome do medicamento" value="<?= $dados[0]['nome_medicamento'] ?>">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Dosagem do Medicamento*</h4>
                    <fieldset>
                        <input name="dosagem" type="text" class="form-control" id="name" placeholder="Digite aqui a dosagem do medicamento e unidade (grama (g) ou miligrama (mg))" value="<?= $dados[0]['dosagem_medicamento'] ?>">
                    </fieldset>

                    <br>

                    <h4 style="color: red">Categoria do Medicamento</h4>
                    <fieldset>
                        <input name="categoria" type="text" class="form-control" id="name" placeholder="Digite aqui para que é indicado o medicamento (pressão, colesterol, diabetes...)" value="<?= $dados[0]['categoria_medicamento'] ?>">
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
                                    <b>Deseja excluir o medicamento:</b> <?= $dados[0]['nome_medicamento'] ?>
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