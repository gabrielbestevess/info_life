<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MedicamentoDAO.php';

if (isset($_POST['btnGravar'])) {

    $nome_medicamento = trim($_POST['nome_medicamento']);
    $dosagem = trim($_POST['dosagem']);
    $categoria = trim($_POST['categoria']);

    $objdao = new MedicamentoDAO();

    $ret = $objdao->CadastrarMedicamento($nome_medicamento, $dosagem, $categoria);
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
                                <h1>Cadastrar Medicamento</h1>
                                <p>Aqui você poderá cadastrar os seus medicamentos de uso contínuo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr><br>

                <form action="cadastrar_medicamento.php" method="post">
                <h4 style="color: red">Nome do Medicamento*</h4>
                <fieldset>
                    <input name="nome_medicamento" type="text" class="form-control" id="name" placeholder="Digite aqui o nome do medicamento">
                </fieldset>

                <br>

                <h4 style="color: red">Dosagem do Medicamento*</h4>
                <fieldset>
                    <input name="dosagem" type="text" class="form-control" id="name" placeholder="Digite aqui a dosagem do medicamento e unidade (grama (g) ou miligrama (mg))">
                </fieldset>

                <br>

                <h4 style="color: red">Categoria do Medicamento</h4>
                <fieldset>
                    <input name="categoria" type="text" class="form-control" id="name" placeholder="Digite aqui para que é indicado o medicamento (pressão, colesterol, diabetes...)">
                </fieldset>

                <br>

                <button name="btnGravar" class="btn btn-success btn-md" style="background-color: #32CD32; color: white; border-color: #32CD32; width: 90px;">Salvar</button>

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