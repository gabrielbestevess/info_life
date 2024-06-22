<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/VacinaDAO.php';

$objdao = new VacinaDAO();

$vacinas = $objdao->ConsultarVacina();

// echo '<pre>';
// print_r($vacinas);
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
                        <?php include_once '_msg.php'; ?>
                            <div class="col-md-12">
                                <h1>Consultar Vacinas</h1>
                                <p>Aqui você poderá consultar as vacinas cadastradas. Caso deseje alterar, clique no botão:</p>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <!-- Tables -->
                <section class="tables">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alternate-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Data de Aplicação</th>
                                                <th>Nome da Vacina</th>
                                                <th>Fornecedor</th>
                                                <th>Lote</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($vacinas); $i++) { ?>

                                                <tr>
                                                    <td><?= $vacinas[$i]['data_vacina'] ?></td>
                                                    <td><?= $vacinas[$i]['nome_vacina'] ?></td>
                                                    <td><?= $vacinas[$i]['fornecedor_vacina'] ?></td>
                                                    <td><?= $vacinas[$i]['lote_vacina'] ?></td>
                                                    <td class="col-md-1">
                                                    <a href="alterar_vacina.php?cod=<?= $vacinas[$i]['id_vacina'] ?>" class="btn btn-sm" style="background-color: red; color: white; font-weight: bold;">Alterar</a>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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