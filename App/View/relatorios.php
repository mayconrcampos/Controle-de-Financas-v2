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
                <a class="nav-link text-dark" href="../../index.php"><i class='bx bx-money'></i> Menu Principal</a>
                </li>
            </ul>
        </nav>


<!-------- Conteúdo principal usuários ------------->
  <div class="conteudo text-center">
  <?php if($_SESSION['sucesso']){?>

      <h3 class="alert-success"><?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); header("Refresh: 1; ./index.php"); ?></h3>

  <?php  }?>

  <?php if($_SESSION['erro']){?>

      <h3 class="alert-danger"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); header("Refresh: 1; ./index.php"); ?></h3>

  <?php  }?>

    
    <!----------- Modal Relatórios ---------------->
  <div id="" class="m-5">
        <h1>Relatórios</h1>


        <div class="tableLista">
            <form method="POST" action="">
              <div class="form-row">
                <div class="col-12 mb-3 text-left">
                  <input type="text" class="form-control" name='descricao' placeholder="Filtrar">
                  <small class="ml-3">Filtrar por: Descrição / Categoria</small>
                </div>
                <div class="col-6">
                  <input type="date" class="form-control" name="data_ini" placeholder="Last name">
                </div>
                <div class="col-6">
                  <input type="date" class="form-control" name="data_fim" placeholder="Last name">
                </div>
                <div class="col-12">
                  <input type="submit" class="form-control btn btn-primary mt-4" name="botao" value="Pesquisar" placeholder="Last name">
                </div>
              </div>
            </form>





              <table class="js-sort-table table table-sm table-responsive-lg table-hover bg-light border border-dark mt-3 ">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">Descrição</th>
                      <th scope="col">Valor (R$)</th>
                      <th scope="col">Data</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Comentário</th>
                      <th scope="col">Tipo</th>
                    </tr>
                </thead>
                <tbody>

                <!----- Aqui vai o laço foreach ------>
            <?php 
                  if(!empty($_POST['botao'])){
                      $pesquisa = $_POST['descricao'];
                      $data_ini = $_POST['data_ini'];
                      $data_fim = $_POST['data_fim'];

                      $totalItens = 0;
                      $valorTotal = 0;

                      $relatorios = new \App\Model\DBcontrole();
                  
                      foreach($relatorios->selectRelatorios($pesquisa, $data_ini, $data_fim, "2") as $linha){  ?>
                          <?php $valorTotal += $linha['valor']; ?>
                          <?php $totalItens++; ?>

                          <tr>
                            <th scope="row"><?= $linha['descricao'] ?></th>
                            <td><?= number_format($linha['valor'], 2, ",", ".") ?></td>
                            <td><?= $linha['data'] ?></td>
                            <td><?= $linha['categoria'] ?></td>
                            <td><?= $linha['comentario'] ?></td>
                            <td class="<?= ($linha['tipo'] == "1") ? "alert alert-success" : "alert alert-danger" ?>"><?= ($linha['tipo'] == "1") ? "Receita" : "Despesa" ?></td>
                          </tr>

                <?php }  ?>
                <div class="table table-sm fixed-bottom">
                  <td class="alert alert-success">Valor Total</td>
                  <td>(R$) <?= number_format($valorTotal, 2, ",", "."); ?>  </td>
                  <td class="alert alert-success">Total Itens</td>
                  <td>(UNI) <?php echo $totalItens ?>  </td>
                
                </div>  
            <?php }  ?>

                <!------- Aqui termina o laço foreach --------->
                  
                </tbody>
              </table>
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
    <script src="../View/js/sort-table.js"></script>
</body>
</html>