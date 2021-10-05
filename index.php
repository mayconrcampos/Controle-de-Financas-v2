<?php
  //include_once("./App/Controller/Funcoes.php");
  //include_once("./App/Controller/IndexDB.php");

use App\Model\DBcontrole;
use App\Model\DBtipoGasto;
use App\Model\DBusuario;
use App\Model\TipoGasto;

include_once("./App/Model/DBcontrole.php");
include_once("./App/Model/DBtipoGasto.php");
include_once("./App/Model/DBusuario.php");

// Add Tipo de gasto
/*if(!empty($_POST['tipo']) and !empty($_POST['categoria'])){
    if(!empty($_POST['cadastrar'])){
      echo "sera?";
    }else{
      echo "Ou não?";
    }
    echo $_POST['tipo'].$_POST['categoria'];
    //$tipoDeGasto = new TipoGasto();

    //$tipoDeGasto->setTipo($_POST['tipo']);
    //$tipoDeGasto->setCategoria(filter_var($_POST['categoria']), FILTER_SANITIZE_STRING);
    //$tipoDeGasto->setIdUser(2);

    unset($_POST['tipo']);
    unset($_POST['categoria']);

    //$DBgasto = new DBtipoGasto();
    //$DBgasto->insert($tipoDeGasto);
  
}*/




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
                <a class="nav-link text-dark" href="#" onclick="listaConta()"><i class='bx bx-list-ul' ></i> Lista Contas</a>
                </li>


                <li class="nav-item dropdown list-unstyled">
                  <a class="nav-link dropdown-toggle align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class='bx bxs-category'></i>Categorias</a>

                  <div class="dropdown-menu">
                    <a class="dropdown-item" onclick="addCategoria()"  href='#'><i class='bx bxs-comment-add'></i> Adicionar</a>
                    <a class="dropdown-item"  href="#" onclick="listaCategorias1()"><i class='bx bx-list-ul' ></i> Listar</a>
                  </div>
                </li>

                <li class="nav-item">
                <a class="nav-link text-dark" href="#" onclick="modRelatorios()"><i class='bx bxs-file-find'></i> Relatórios</a>
                </li>
            </ul>
        </nav>


<!-------- Conteúdo principal usuários ------------->
  <div class="conteudo text-center">

    <img src="./App/View/css/Logo.png" class="img-fluid" alt="Responsive image">







    <!-------- Modal Adiciona Conta ------------->
    <div class="ModaddConta">
          <div onclick="fecharAddConta()" class="fecharAddConta">x</div>
          <h1>Adicionar Conta</h1>
          <div class="formulario border border-dark rounded">
            
              <form class="m-3" action="#" method="post">
                <div class="form-check form-check-inline">
                  <fieldset>

                    <div class="d-inline alert alert-primary rounded" role="alert">
                      <input type="radio" name="tipo" value="1" class="form-check-input" >
                      <label for="receitas" class="form-check-label">Receita</label>
                    </div>

                    <div class="d-inline alert alert-danger rounded" role="alert">
                      <input type="radio" name="tipo" value="2" class="form-check-input" checked>
                      <label for="despesas" class="form-check-label">Despesa</label>
                    </div>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Descrição</span>
                        </div>
                        <input type="text" aria-label="First name" class="form-control form-control-lg" name="descricao" required autofocus>
                    </div><br>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">R$</span>
                        </div>

                        <input type="text" name="valor" class="form-control form-control-lg" aria-label="Quantia" required>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Data</span>
                        </div>
                        <input type="date" aria-label="First name" class="form-control form-control-lg" name="data" required>
                    </div><br>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01" name="categoria">Categoria</label>
                        </div>

                        <select class="custom-select custom-select-lg" id="inputGroupSelect01" name="categoria" required>
                    <?php $TipoGasto = new \App\Model\DBtipoGasto();  
                          foreach($TipoGasto->select() as $gasto){      ?>
                            <option selected>------ Receitas ------</option>
                          <?php if($gasto['tipo'] == "1"){?>

                                <option value="<?php echo $gasto['categoria']?>"><?php echo $gasto['categoria']?></option>

                          <?php }else{?>
                            <option selected>------ Despesas ------</option>


                            <option value="<?php echo $gasto['categoria']?>"><?php echo $gasto['categoria']?></option>
                          <?php } ?>


                    <?php } ?>
                        </select>

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

    <?php 
      
    ?>



    <!----------- Modal Table Lista Conta ---------------->
    <div id="ModlistaConta" class="ModlistaConta">
        <div onclick="fecharListaContas()" class="fecharListaContas">x</div>
        <h1>Movimentação Financeira</h1>


        <div class="tableLista">
              <table class="table table-lg table-responsive-xl table-hover border border-dark">
                <thead>
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
                    <td><?php echo $linha['valor'] ?>                  </td>
                    <td><?php echo $linha['data'] ?>                   </td>
                    <td><?php echo $linha['categoria'] ?>              </td>
                    <td><?php echo $linha['comentario'] ?>             </td>
                    <td <?php echo ($linha['tipo'] == "0") ? "class='alert-danger'" : "class='alert-primary'" ; ?> ><?php echo ($linha['tipo'] == "0") ? 'Despesa' : 'Receita'; ?>                   </td>
                  </tr>

          <?php   } 
                  $saldo = $receita - $despesa; ?>
                </tbody>
                <div class="sticky-bottom">
                  <td>Receitas</td>
                  <td>(R$) <?php echo number_format($receita, 2, ",", "."); ?>  </td>
                  <td>Despesa</td>
                  <td>(R$) <?php echo number_format($despesa, 2, ",", "."); ?>  </td>
                  <td>Saldo</td>
                  <td>(R$) <?php echo number_format($saldo, 2, ",", "."); ?>    </td>
                </div>
               

              </table>
        </div>

    </div>

    

  
    <!-------- Modal Adiciona Categoria ------------->
    <div class="ModaddCategoria">
          <div onclick="fecharAddCategoria()" class="fecharAddCategoria">x</div>
          <h1>Adicionar Categoria</h1>
          <div class="formulario border border-dark rounded">
            
              <form class="m-3" action="" method="POST">
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


        <div class="tableLista">
              <table class="table table-lg table-responsive-xl table-hover border border-dark">
                <thead>
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descrição (R$)</th>
                    </tr>
                </thead>
                <tbody>

                <!----- Aqui vai o laço foreach ------>
                  <tr>
                    <th scope="row">Super Santos</th>
                    <td>50,00</td>
                  </tr>
                <!------- Aqui termina o laço foreach --------->
                  
                </tbody>
              </table>
        </div>
    </div>


    <!----------- Modal Relatórios ---------------->
  <div id="modRelatorios" class="modRelatorios">
        <div onclick="fechaRelatorios()" class="fechaRelatorios">x</div>
        <h1>Relatórios</h1>


        <div class="tableLista">
          <div class="row text-left">
          <div class="form-group col-6">
                              
                              <label>Filtrar por</label>
                              <input type="text" aria-label="First name" id="descricao" class="form-control form-control-lg" name="descricao" autofocus>
                              <small id="" class="form-text text-muted">Filtrar por Descrição, Categoria, Comentário ou Intervalo.</small>
              </div>
              <div class="form-group col-3">
                             
                              <label>Data Inicio</label>
                              <input type="date" aria-label="First name" id="descricao" class="form-control form-control-lg" name="descricao" autofocus>
              </div>
              <div class="form-group col-3">
                             
                              <label>Data Fim</label>
                              <input type="date" aria-label="First name" id="descricao" class="form-control form-control-lg" name="descricao" autofocus>
              </div>
          </div>
              

              <table class="table table-lg table-responsive-xl table-hover border border-dark mt-3 ">
                <thead>
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
                  <tr>
                    <th scope="row">Super Santos</th>
                    <td>50,00</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>


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

    <script src="./App/View/js/script.js"></script>
    <script src="./App/View/js/dashboard.js"></script>
    <script src="./App/View/dist/js/jquery-3.2.1.slim.min.js"></script>
    <script src="./App/View/dist/js/popper.min.js"></script>
    <script src="./App/View/dist/js/bootstrap.min.js"></script>
</body>
</html>