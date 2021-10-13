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
include_once("../Controller/Funcoes.php");

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
                <a class="nav-link text-dark" href="./relatorios.php"><i class='bx bxs-file-find'></i> Relatórios</a>
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
        <h1>Gráficos de Balanços mensais com relação a entradas e saídas</h1>

<!------------- Limite do conteúdo ------------------>    
            <fieldset>
                 <img src="../Controller/getGraph.php" alt="Balanços dos gastos mensais" title="Balanço dos gastos mensais" />
            </fieldset>  
        
    </div>

  
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