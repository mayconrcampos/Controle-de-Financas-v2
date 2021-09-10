<?php


function filtrando($filtro, $descricao){
    $filtro = $_POST['filtro'];
    $descricao = $_POST['descricao'];

    if(!empty($filtro) and !empty($descricao)){
        $style =    '<style>.modal {'
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
                            .'overflow: hidden;'

                            .'animation: animate;'
                            .'animation-duration: 500ms;'
                        .'}'

                        .'@keyframes animate {'
                            .'from{opacity: 1;}'
                            .'from{opacity: 0;}'
                          .'}'
                .'</style>';
        
        $modal = '<div id="" class="modal">'
                .'<div onclick="fechamodal()" class="fecharListaContas">x</div>'
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
        $tablebody .='<tr>'
                    .'<th scope="row">'.$valores[0].'</th>'
                    .'<td>'.$valores[1].'</td>'
                  .'</tr>';
    }

    echo $style.$modal.$tablehead.$tablebody.$tabletail;

    }else{
        echo "nada";
    }
}

