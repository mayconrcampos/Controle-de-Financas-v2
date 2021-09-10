<?php
//
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
                    <a class="dropdown-item"  href="#"><i class='bx bx-list-ul' ></i> Listar</a>
                  </div>
                </li>

                <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class='bx bxs-file-find'></i> Relatórios</a>
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
                      <input type="radio" name="filtro" value="1" class="form-check-input" >
                      <label for="receitas" class="form-check-label">Receita</label>
                    </div>

                    <div class="d-inline alert alert-danger rounded" role="alert">
                      <input type="radio" name="filtro" value="0" class="form-check-input" checked>
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
                            <option selected>------ Receitas ------</option>

                                <option value=""></option>

                            <option selected>------ Despesas ------</option>

                                <option value=""></option>

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
                  <tr>
                    <th scope="row">Super Santos</th>
                    <td>50,00</td>
                    <td>10/09/2021</td>
                    <td>Mercado</td>
                    <td>Carne</td>
                    <td>Despesa</td>
                  </tr>
                  <tr>
                    <th scope="row">Posto Vila Nova</th>
                    <td>100,00</td>
                    <td>10/09/2021</td>
                    <td>Gasolina</td>
                    <td></td>
                    <td>Despesa</td>
                  </tr>
                </tbody>
              </table>
        </div>

    </div>

    

  
    <!-------- Modal Adiciona Categoria ------------->
    <div class="ModaddCategoria">
          <div onclick="fecharAddCategoria()" class="fecharAddCategoria">x</div>
          <h1>Adicionar Categoria</h1>
          <div class="formulario border border-dark rounded">
            
              <form class="m-3" action="#" method="post">
                <div class="form-check form-check-inline">
                  <fieldset>

                    <div class="d-inline alert alert-primary rounded" role="alert">
                      <input type="radio" name="filtro" id="filtro" value="1" class="form-check-input" checked>
                      <label for="receitas" class="form-check-label">Receita</label>
                    </div>

                    <div class="d-inline alert alert-danger rounded" role="alert">
                      <input type="radio" name="filtro" id="filtro" value="0" class="form-check-input" >
                      <label for="despesas" class="form-check-label">Despesa</label>
                    </div>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Descrição</span>
                        </div>
                        <input type="text" aria-label="First name" id="descricao" class="form-control form-control-lg" name="descricao" required autofocus>
                    </div><br>

                    <input id="inputcategoria" type="submit" value="Cadastrar" class="btn btn-primary btn-lg btn-block">

                  </fieldset>
                </div>
              </form>

          </div>
          
    </div>



  <!-------------------- Próximo Modal --------------------------->


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