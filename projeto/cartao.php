<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$objdao = new UsuarioDAO();

$dados = $objdao->CarregarMeusDados();

switch ($dados[0]['tipo_sanguineo']) {
    case '1':
        $tipo = 'A+';
        break;
    case '2':
        $tipo = 'A-';
        break;
    case '3':
        $tipo = 'B+';
        break;
    case '4':
        $tipo = 'B-';
        break;
    case '5':
        $tipo = 'AB+';
        break;
    case '6':
        $tipo = 'AB-';
        break;
    case '7':
        $tipo = 'O+';
        break;
    case '8':
        $tipo = 'O-';
        break;
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
                            <div class="col-md-12">
                                <h1>Cartão Doador</h1>
                                <p>Aqui você poderá visualizar seu cartão doador, incluindo o seu tipo sanguíneo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="bodyCartao">
                    <div class="cardCartao">
                        <h1 class="h1Cartao">Doador de Sangue</h1>
                        <br><br>
                        <p class="p1Cartao"><strong>Nome Completo: </strong><input value="<?= $dados[0]['nome_usuario'] ?>" class="inputCartao" disabled size="35"></p><br>
                        <p class="p1Cartao"><strong>Data de Nascimento: </strong><input value="<?= $dados[0]['data_nascimento'] ?>" class="inputCartao" type="date" disabled></p><br>
                        <p class="p1Cartao"><strong>Tipo Sanguíneo: </strong><input value="<?= $dados[0]['tipo_sanguineo'] ? $tipo : '' ?>" class="inputCartao" disabled size="3"></p><br>
                    </div>
                </div>

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