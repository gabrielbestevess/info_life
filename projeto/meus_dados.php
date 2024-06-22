<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$objdao = new UsuarioDAO();

if (isset($_POST['btnGravar'])) {
  $nome = $_POST['nome'];
  $data_nasc = $_POST['data_nasc'];
  $tipo_sangue = $_POST['tipo'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];

  $ret = $objdao->GravarMeusDados($nome, $data_nasc, $tipo_sangue, $email, $telefone);
}

$dados = $objdao->CarregarMeusDados();

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
                <h1>Meus Dados</h1>
                <p>Aqui você poderá alterar seus dados</p>
              </div>
            </div>
          </div>
        </div>
        <hr><br>

        <form action="meus_dados.php" method="post">

          <h4 style="color: red">Nome*</h4>
          <fieldset>
            <input name="nome" type="text" class="form-control" id="name" placeholder="Digite aqui seu nome" value="<?= $dados[0]['nome_usuario'] ?>">
          </fieldset>

          <br>

          <h4 style="color: red">Data de Nascimento*</h4>
          <fieldset>
            <input name="data_nasc" type="date" class="form-control" id="name" value="<?= $dados[0]['data_nascimento'] ?>">
          </fieldset>

          <br>

          <h4 style="color: red">E-mail*</h4>
          <fieldset>
            <input name="email" type="text" class="form-control" id="name" placeholder="Digite aqui seu e-mail" value="<?= $dados[0]['email_usuario'] ?>">
          </fieldset>

          <br>

          <h4 style="color: red">Tipo Sanguíneo*</h4>
          <fieldset>
            <select class="form-control" name="tipo" id="">
              <option value="1" <?= $dados[0]['tipo_sanguineo'] == '1' ? 'selected' : '' ?>>A+</option>
              <option value="2" <?= $dados[0]['tipo_sanguineo'] == '2' ? 'selected' : '' ?>>A-</option>
              <option value="3" <?= $dados[0]['tipo_sanguineo'] == '3' ? 'selected' : '' ?>>B+</option>
              <option value="4" <?= $dados[0]['tipo_sanguineo'] == '4' ? 'selected' : '' ?>>B-</option>
              <option value="5" <?= $dados[0]['tipo_sanguineo'] == '5' ? 'selected' : '' ?>>AB+</option>
              <option value="6" <?= $dados[0]['tipo_sanguineo'] == '6' ? 'selected' : '' ?>>AB-</option>
              <option value="7" <?= $dados[0]['tipo_sanguineo'] == '7' ? 'selected' : '' ?>>O+</option>
              <option value="8" <?= $dados[0]['tipo_sanguineo'] == '8' ? 'selected' : '' ?>>O-</option>
            </select>
          </fieldset>

          <br>

          <h4 style="color: red">Telefone de Contato</h4>
          <fieldset>
            <input name="telefone" type="text" class="form-control" id="name" placeholder="(xx) x xxxx-xxxx" value="<?= $dados[0]['telefone_usuario'] ?>">
          </fieldset>

          <br>

          <button type="submit" name="btnGravar" class="btn btn-success btn-md" style="background-color: #32CD32; color: white; border-color: #32CD32;  width: 90px;">Salvar</button>
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