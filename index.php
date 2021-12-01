<?php

session_start();

use App\Model\DBcontrole;
use App\Model\DBtipoGasto;
use App\Model\DBusuario;
use App\Model\TipoGasto;

include_once("./App/Model/DBcontrole.php");
include_once("./App/Model/DBtipoGasto.php");
include_once("./App/Model/DBusuario.php");
include_once("./App/Model/Controle.php");
include_once("./App/Controller/Funcoes.php");

?>

<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./App/View/dist/css/bootstrap.min.css">
    <title>Sistema de Controle Financeiro - v2.0</title>
    <link rel="stylesheet" href="./App/View//css/style.css">
    
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
  <a class="m-1" href="#"><img class="img-fluid" alt="Responsive image" src="./App/View/css/cifrao.png" width="60px"></a>
</nav>

<!-------- Sidebar Menu esquerdo ----------->

<div class="d-flex">
        <nav id= "sidebar1" class="sidebar d-inline-flex">
            <ul class="list-unstyled m-3">
            <li class="nav-item">
                <a class="nav-link text-dark" href="#" onclick="addConta()"><i class='bx bx-money'></i> Adiciona Conta</a>
                </li>

                <li class="nav-item">
                <a class="nav-link text-dark" href="#" onclick="listaConta()"><i class='bx bx-list-ul'></i> Lista Contas</a>
                </li>


                <li class="nav-item dropdown list-unstyled">
                  <a class="nav-link dropdown-toggle align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class='bx bxs-category'></i>Categorias</a>

                  <div class="dropdown-menu">
                    <a class="dropdown-item" onclick="addCategoria()"  href='#'><i class='bx bxs-comment-add'></i> Adicionar</a>
                    <a class="dropdown-item" onclick="listaCategorias1()" href="#"><i class='bx bx-list-ul' ></i> Listar</a>
                  </div>
                </li>

                <li class="nav-item">
                <a class="nav-link text-dark" href="./App/View/relatorios.php"><i class='bx bxs-file-find'></i> Relatórios</a>
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

    <img src="./App/View/css/Logo.png" class="img-fluid" alt="Responsive image">




    <!-------- Modal Adiciona Conta ------------->
    <div id="modaddConta" class="ModaddConta">
          <div onclick="fecharAddConta()" class="fecharAddConta">x</div>
          <h1>Adicionar Conta</h1>
          <div class="formulario border border-dark rounded p-2 bg-light">
            
              <form class="m-1" action="./App/Controller/ADDconta.php" method="post">
                <div class="form-check form-check-inline">
                  <fieldset>

                    <div class="d-inline alert alert-primary rounded" role="alert">
                      <input type="radio" name="tipo" value="1" class="form-check-input" >
                      <label for="receitas" class="form-check-label">Receita</label>
                    </div>

                    <div class="d-inline alert alert-danger rounded" role="alert">
                      <input type="radio" name="tipo" value="0" class="form-check-input" checked>
                      <label for="despesas" class="form-check-label">Despesa</label>
                    </div>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Descrição</span>
                        </div>
                        <input type="text" aria-label="First name" class="form-control form-control-lg" name="descricao" autofocus>
                    </div><br>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>

                        <input type="text" name="valor" class="form-control form-control-lg" aria-label="Quantia">
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Data</span>
                        </div>
                        <input type="date" aria-label="First name" class="form-control form-control-lg" name="data">
                    </div><br>


                    

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01" name="categoria">Categoria</label>
                        </div>

                        <select class="custom-select custom-select-lg" id="inputGroupSelect01" name="categoria">
                            <option selected>------ Receitas ------</option>

                    <?php $TipoReceita = new \App\Model\DBtipoGasto();  
                          
                          foreach($TipoReceita->select() as $receita){      ?>

                          <?php if($receita['tipo'] == "1"){?>

                                <option value="<?php echo $receita['categoria']?>"><?php echo $receita['categoria']?></option>

                          <?php }?>
                    <?php } ?>

                            <option selected>------ Despesas ------</option>

                    <?php $TipoDespesa = new \App\Model\DBtipoGasto();
                     
                          foreach($TipoDespesa->select() as $despesa){?>
                          
                          <?php if($despesa['tipo'] == "0"){?>

                            <option value="<?php echo $despesa['categoria']?>"><?php echo $despesa['categoria']?></option>

                          <?php } ?>
                    <?php } ?>

                        </select>

                    </div>

                    <small class="">Faltou alguma categoria na lista?</small>

                    <div class="alert alert-primary text-center">
                        <a class="nav-link text-dark text-center" href="#" onclick="addCategoria()">Adicione uma Categoria</a>
                    </div>
                    

                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Comentários</span>
                        </div>
                        <input type="text" aria-label="First name" class="form-control form-control-lg" name="comentario">
                    </div><br>

                    <input type="submit" value="Inserir" class="btn btn-primary btn-lg btn-block">

                  </fieldset>
                </div>
              </form>

          </div>
          
    </div>




    <!----------- Modal Table Lista Conta ---------------->
    <div id="ModlistaConta" class="ModlistaConta">
        <div onclick="fecharListaContas()" class="fecharListaContas">x</div>
        <?php $mesCorrente = date("m"); $anoCorrente = date("Y"); ?>
        <h2>Movimentação Financeira Mês de <?=  Funcoes::mesesDoAno($mesCorrente); ?> de <?= $anoCorrente ?></h2>
        <small>Para visualizar movimentações de outros meses, vá em <a href="./App/View/relatorios.php"> Relatórios.</a></small>


        <div class="tableLista w-100">
              <table class="js-sort-table table table-sm table-responsive-lg table-hover border border-dark bg-light w-100">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor (R$)</th>
                    <th scope="col">Data</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Comentário</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                  </tr>
                </thead>
                <tbody>
          <?php   $contas = new \App\Model\DBcontrole();
                  $despesa = 0;
                  $receita = 0;
                  $saldo = 0;
                  foreach($contas->select() as $linha) {
                    if($linha['tipo'] == "0"){
                      $despesa += $linha['valor'];
                    }else{
                      $receita += $linha['valor'];
                    }                                      ?>

                  <tr>
                    <th scope="row"><?php echo $linha['descricao'] ?>  </th>
                    <td><?php echo number_format($linha['valor'], 2, ",", ".") ?>                  </td>
                    <td><?php echo $linha['data'] ?>                   </td>
                    <td><?php echo $linha['categoria'] ?>              </td>
                    <td><?php echo $linha['comentario'] ?>             </td>
                    <td <?php echo ($linha['tipo'] == "0") ? "class='alert-danger'" : "class='alert-success'" ; ?> >  <?php echo ($linha['tipo'] == "0") ? 'Despesa' : 'Receita'; ?>                   </td>
                    <td><a onclick="addConta()" href="./App/View/EDconta.php?id=<?= $linha['id'] ?>" onclick="addConta()"><i class='bx bx-edit'></i></a></td>
                    <td><a href="./App/Controller/DELconta.php?id=<?= $linha['id'] ?>" onclick="return confirm('Deseja realmente excluir este registro?')"><i class='bx bx-trash'></i></a></td>
                  </tr>

          <?php   }
                  $saldo = $receita - $despesa; ?>
                </tbody>    
                <div class="table table-sm fixed-bottom">
                  <td class="alert alert-success">Receitas</td>
                  <td>(R$) <?php echo number_format($receita, 2, ",", "."); ?>  </td>
                  <td class="alert alert-danger">Despesa</td>
                  <td>(R$) <?php echo number_format($despesa, 2, ",", "."); ?>  </td>
                  <td class="<?= ($saldo >= 0) ? "alert alert-success" : "alert alert-danger" ?>">Saldo</td>
                  <td>(R$) <?php echo number_format($saldo, 2, ",", "."); ?>    </td>
                </div>  

              </table>
              
        </div>
        

    </div>

    

  
    <!-------- Modal Adiciona Categoria ------------->
    <div class="ModaddCategoria">
          <div onclick="fecharAddCategoria()" class="fecharAddCategoria">x</div>
          <h1>Adicionar Categoria</h1>
          <div class="formulario border border-dark rounded p-3 bg-light">
            
              <form class="m-3" action="./App/Controller/ADDcategoria.php" method="POST">
                <div class="form-check form-check-inline">
                
                  <fieldset>

                    <div class="d-inline alert alert-primary rounded" role="alert">
                      <input type="radio" name="tipo" id="filtro" value="1" class="form-check-input" checked>
                      <label for="receitas" class="form-check-label">Receita</label>
                    </div>

                    <div class="d-inline alert alert-danger rounded" role="alert">
                      <input type="radio" name="tipo" id="filtro" value="0" class="form-check-input" >
                      <label for="despesas" class="form-check-label">Despesa</label>
                    </div>

                    

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Categoria</span>
                        </div>
                        <input type="text" aria-label="First name" id="categoria" class="form-control form-control-lg" name="categoria" autofocus>
                    </div><br>

                    <button id="inputcategoria" type="submit" name="cadastrar" class="btn btn-primary btn-lg btn-block">Cadastrar</button>

                  </fieldset>
                </div>
              </form>

          </div>
        
          
    </div>

  

 



  <!----------- Modal Table Lista de Categorias ---------------->
  <div id="modlistaCategorias1" class="modlistaCategorias1">
        <div onclick="fechalistaCategorias1()" class="fechalistaCategorias1">x</div>
        <h1>Lista de Categorias</h1>


        <div class="tableLista w-100">
              <table class="js-sort-table table table-sm table-responsive-lg table-hover border border-dark w-100">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descrição (R$)</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>

                <!----- Aqui vai o laço foreach ------>
                <?php $categoria = new \App\Model\DBtipoGasto(); 
                
                  foreach($categoria->select() as $cat){ ?>
                  <tr <?= ($cat['tipo'] == "0") ? "class='alert-danger'" : "class='alert-success'" ?>>
                    <th scope="row"><?= ($cat['tipo'] == "0") ? "Despesa" : "Receita" ?></th>
                    <td><?= $cat['categoria'] ?></td>
                    <td><a href="./App/View/EDtipo.php?id=<?= $cat['id'] ?>"> <i class='bx bx-edit'></i> </a></td>
                    <td><a href="./App/Controller/DELtipo.php?id=<?= $cat['id'] ?>" onclick="return confirm('Você realmente deseja excluir este registro?')"> <i class='bx bx-trash'></i> </a></td>
                  </tr>
                <!------- Aqui termina o laço foreach --------->
            <?php } ?>
                </tbody>
              </table>
        </div>
    </div>

    <!--------------- Limite do conteúdo ------------------>

</div>

                
    <!----------------- Footer ------------------->
    <footer class="text-center footer fixed-bottom">
      <div class="container">
        <span class="text-muted">Sistema de Controle Financeiro v2.0 ® Copyright 09-2021
        </span>
      </div>
    </footer>

    <script src="./App/View/js/script.js"></script>
    <script src="./App/View/js/dashboard.js"></script>
    <script src="./App/View/dist/js/jquery-3.2.1.slim.min.js"></script>
    <script src="./App/View/dist/js/popper.min.js"></script>
    <script src="./App/View/dist/js/bootstrap.min.js"></script>
    <script src="./App/View/js/funcoes.js"></script>
    <script src="./App/View/js/sort-table.js"></script>
</body>
</html>