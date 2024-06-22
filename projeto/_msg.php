<?php

if (isset($_GET['ret'])) {

    $ret = $_GET['ret'];
}

if (isset($ret)) {

    switch ($ret) {

        case 0:
            echo '<div class="alert alert-warning">
                    Preencher o(s) campo(s) obrigatório(s)!
                  </div>';
            break;
        case 1:
            echo '<div class="alert alert-success">
                    Ação realizada com sucesso!
                  </div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
                    Ocorreu um erro na operação. Tente novamente mais tarde!
                  </div>';
            break;
        case -2:
            echo '<div class="alert alert-info">
                    O nome deverá conter no mínimo 3 caracteres!
                  </div>';
            break;
        case -3:
            echo '<div class="alert alert-info">
                    A senha deverá conter no mínimo 6 caracteres!
                  </div>';
            break;
        case -4:
            echo '<div class="alert alert-danger">
                    A Senha e Repetir Senha deverão ser iguais!
                  </div>';
            break;
        case -5;
            echo '<div class="alert alert-danger">
                    O registro não poderá ser excluído, pois está em uso!
                 </div>';
            break;
        case -6;
            echo '<div class="alert alert-danger">
                    E-mail já cadastrado. Coloque um outro e-mail!
                  </div>';
            break;
        case -7;
            echo '<div class="alert alert-danger">
                    Usuário não encontrado!
                  </div>';
            break;
        case -8;
            echo '<div class="alert alert-danger">
                    Data Final não pode ser menor que a Inicial!
                 </div>';
            break;
        case -9;
            echo '<div class="alert alert-danger">
                    E-mail inválido!
                 </div>';
            break;
    }

}
