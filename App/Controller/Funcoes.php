<?php

class Funcoes {
    static function validaValor($num){
      $conta = 0;                     // Variável de controle.
      $num1 = str_split($num);        // Transforma string em um array
      foreach($num1 as $n) {          // Itera elemento por elemento desse array
          if($n == ","){              // Procura pelo elemento "," <- vírgula
              $conta++;               // Se encontrar o elemento vírgula, incrementa variável $conta.
          }
      }
      if($conta == 0){                // Se conta for igual a zero, não tiver vírgula ...
          if(is_numeric($num)){       // Se for inteiro
              $num = (double) $num;   // Transforma essa string em um double
              return $num;            // Retorna este double.
          }elseif(is_float($num)){    // Se for float puro, com ponto.
              $num = (double) $num;   // Transforma essa string em um double
              return $num;            // Retorna este double.
          }else{                      // Se não for porra nenhuma, nem número é.
              return false;           // Retorna false
          }
      }elseif($conta == 1){                       // Se tiver uma vírgula como separador.
          $num = str_replace(",", ".", $num);     // Troca essa vírgula por um ponto.
          return (double) $num;                   // Transforma essa string em double e retorna.
      }else{                                      // Se não for nada disso acima, então ele tem mais vírgulas, logo é um número inválido.
          return false;
        
      }
    }

    static function submitCategorias($filtro, $descricao){
        $filtro = $_POST['filtro'];
        $descricao = $_POST['descricao'];
    
        if(isset($_POST['Cadastrar'])){
          if(!empty($filtro) and !empty($descricao)){

            $style =    '<style>
            .modlistaCategorias {'
              .'border-radius: 3px 3px 3px 3px;'
              .'box-shadow: 1px 4px 5px 8px black;'
              .'width: 80%;'
              .'height: 80%;'
              .'padding: 20px;'
              .'background-color: var(--blue-analog);'
              .'display: inline-block;'
              .'color: black;'
              .'position: absolute;'
              .'top: 55%;'
              .'left: 50%;'
              .'transform: translate(-50%, -50%);'
              .'display: block;'
              .'overflow: auto;'

              .'animation: animate;'
              .'animation-duration: 500ms;'
              .'}'

                .'.sidebar {'
                    .'margin-left: -250;'
                .'}'
                
                .'@keyframes animate {'
                    .'from{opacity: 1;}'
                    .'from{opacity: 0;}'
                .'}'
                  .'</style>';

              $modal = '<div id="" class="modlistaCategorias">'
                  .'<div onclick="fechalistaCategorias()" class="fechalistaCategorias">x</div>'
                  .'<h1>Lista de Categorias</h1>'
                  .'<div class="tableLista">';

              $tablehead = '<table class="table table-lg table-responsive-xl table-hover border border-dark">'
                  .'<thead>'
                    .'<tr>'
                      .'<th scope="col">Tipo</th>'
                      .'<th scope="col">Descrição (R$)</th>'
                    .'</tr>'
                  .'</thead>'
                  .'<tbody>';

              $tablebody = "";

              $tabletail = '</tbody>'
                .'</table>'
              .'</div>'
              .'</div>';


              $itens[] = [$filtro, $descricao];
              foreach($itens as $valores){
              $tablebody .= '<tr>'
                         .'<th scope="row">'.$valores[0].'</th>'
                         .'<td>'.$valores[1].'</td>'
                        .'</tr>';
              }

              echo $style.$modal.$tablehead.$tablebody.$tabletail;
          }else{
            $style = '<style>
            .alerta {'
              .'border-radius: 3px 3px 3px 3px;'
              .'box-shadow: 1px 4px 5px 8px black;'
              .'width: 50%;'
              .'height: 30%;'
              .'padding: 20px;'
              .'background-color: var(--blue-analog);'
              .'display: inline-block;'
              .'color: black;'
              .'position: absolute;'
              .'top: 55%;'
              .'left: 50%;'
              .'transform: translate(-50%, -50%);'
              .'display: block;'
              .'overflow: auto;'

              .'animation: animate;'
              .'animation-duration: 500ms;'
              .'}'

              .'.fechaAlerta {'
              .'width: 30px;'
              .'height: 30px;'
              .'border-radius: 50%;'
              .'float: right;'
              .'cursor: pointer;'
              .'}'

                .'.sidebar {'
                    .'margin-left: -250;'
                .'}'
                
                .'@keyframes animate {'
                    .'from{opacity: 1;}'
                    .'from{opacity: 0;}'
                .'}'
                  .'</style>';
              
              $modal = '<div id="" class="alerta">'
              .'<div onclick="fechaAlerta()" class="fechaAlerta">x</div>'
              .'<h1>Alerta!</h1>'
              .'<div class="">';

              $aviso = "<h2>É preciso preencher o campo.</h2>";


              $tail = '</div>'
              .'</div>';

              
              unset($_POST['cadastrar']);
              unset($_POST['filtro']);
              unset($_POST['descricao']);
              echo $style.$modal.$aviso.$tail;
          }

        }
    }

}



