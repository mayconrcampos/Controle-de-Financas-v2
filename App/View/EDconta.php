<?php

session_start();

use App\Model\DBcontrole;
use App\Model\DBtipoGasto;
use App\Model\DBusuario;
use App\Model\TipoGasto;

include_once("../Model/DBcontrole.php");
include_once("../Model/DBtipoGasto.php");
include_once("../Model/DBusuario.php");
include_once("../Model/Controle.php");

if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $DBconta = new \App\Model\DBcontrole();

    foreach($DBconta->select($id) as $conta);
}

?>

<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../View/dist/css/bootstrap.min.css">
    <title>Sistema de Controle Financeiro - v2.0</title>
    <link rel="stylesheet" href="../View//css/style.css">
    
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

<!------- Nav Bar Superior---------->

<nav id="nav" class="navbar navbar-light justify-content-between">
  <a href="#" id="botao" onclick=btnClique() class="sidebar-toggle text-white m-2 mr-auto" value="Sim"><i class='bx bx-menu'></i></a>
  <div class="m-auto">
    <h2>Sistema de Controle Financeiro</h2>
  </div>
  

  <li class="nav-item dropdown m-2 list-unstyled">
    <a class="nav-link dropdown-toggle text-white align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <i class='bx bxs-user m-2'>usuario</i>
    </a>
  
    <div class="dropdown-menu">
      <a class="dropdown-item"  href='#'><i class='bx bx-user mr-4'></i>Usuários</a>
      <div class="dropdown-divider" href="#"></div>
      <a class="dropdown-item"    href="#"><i class='bx bxs-user-account mr-4'></i>Perfil</a>
      <a class="dropdown-item"    href="#"><i class='bx bxs-exit mr-4'></i>Sair</a>
    </div>
  </li>
  <a class="m-1" href="#"><img class="img-fluid" alt="Responsive image" src="../View/css/cifrao.png" width="60px"></a>
</nav>

<!-------- Sidebar Menu esquerdo ----------->

<div class="d-flex">
        <nav id= "sidebar1" class="sidebar d-inline-flex">
            <ul class="list-unstyled m-3">
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../index.php" onclick="addConta()"><i class='bx bx-money'></i> Menu Principal</a>
                </li>

            </ul>
        </nav>


<!-------- Conteúdo principal usuários ------------->
  <div class="conteudo text-center">
    
    <!-------- Modal Edita Conta ------------->
    <div id="modEdConta" class="ModEdConta">
          <h1>Editar esta movimentação</h1>
          <div class="formulario border border-dark rounded p-3 bg-light">
            
              <form class="m-2" action="../Controller/EDcontaDB.php" method="post">
                <div class="form-check form-check-inline">
                  <fieldset>

                    <div class="d-inline alert alert-primary rounded" role="alert">
                      <input type="radio" name="tipo" value="1" class="form-check-input" <?= ($conta['tipo'] == "1") ? "checked" : "" ?>>
                      <label for="receitas" class="form-check-label">Receita</label>
                    </div>

                    <div class="d-inline alert alert-danger rounded" role="alert">
                      <input type="radio" name="tipo" value="0" class="form-check-input" <?= ($conta['tipo'] == "0") ? "checked" : "" ?>>
                      <label for="despesas" class="form-check-label">Despesa</label>
                    </div>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Descrição</span>
                        </div>
                        <input type="text" aria-label="First name" class="form-control form-control-lg" name="descricao" value="<?= $conta['descricao'] ?>">
                    </div><br>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>

                        <input type="text" name="valor" class="form-control form-control-lg" aria-label="Quantia" value="<?= $conta['valor'] ?>">
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Data</span>
                        </div>
                        <input type="date" aria-label="First name" class="form-control form-control-lg" name="data" value="<?= $conta['data'] ?>">
                    </div><br>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01" name="categoria">Categoria</label>
                        </div>

                        <select class="custom-select custom-select-lg" id="inputGroupSelect01" name="categoria">

                        <!-------- Preenche primeiro as Receitas-------->
                        <option selected>------ Receitas ------</option>
                    <?php $TipoReceita = new \App\Model\DBtipoGasto();  
                          
                          foreach($TipoReceita->select() as $receita){      ?>

                          <?php if($receita['tipo'] == "1"){?>

                                <option value="<?php echo $receita['categoria']?>"><?php echo $receita['categoria']?></option>

                          <?php }?>
                    <?php } ?>
                        <!---------   Preenche as despesas   ----------->
                        <option selected>------ Despesas ------</option>

                    <?php $TipoDespesa = new \App\Model\DBtipoGasto();
                     
                          foreach($TipoDespesa->select() as $despesa){?>
                          
                          <?php if($despesa['tipo'] == "0"){?>

                            <option value="<?php echo $despesa['categoria']?>"><?php echo $despesa['categoria']?></option>
                          <?php } ?>
                    <?php } ?>

                            <option selected value="<?= $conta['categoria'] ?>"><?= $conta['categoria'] ?></option>

                        </select>

                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Comentários</span>
                        </div>
                        <input type="hidden" name="id" value="<?= $conta['id'] ?>">
                        <input type="text" aria-label="First name" class="form-control form-control-lg" name="comentario" value="<?= $conta['comentario'] ?>">
                    </div><br>

                    <input type="submit" value="Editar" class="btn btn-primary btn-lg btn-block">

                  </fieldset>
                </div>
              </form>

          </div>
          
    </div>

  


  <!------------- Limite do conteúdo ------------------>    
  </div>

</div>

                
    <!----------------- Footer ------------------->
    <footer class="text-center footer fixed-bottom">
      <div class="container">
        <span class="text-muted">Sistema de Controle Financeiro v2.0 ® Copyright 09-2021
        </span>
      </div>
    </footer>

    <script src="../View/js/script.js"></script>
    <script src="../View/js/dashboard.js"></script>
    <script src="../View/dist/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../View/dist/js/popper.min.js"></script>
    <script src="../View/dist/js/bootstrap.min.js"></script>
    <script src="../View/js/funcoes.js"></script>
</body>
</html>