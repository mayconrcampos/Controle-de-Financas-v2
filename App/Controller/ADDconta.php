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



    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
    $valor = Funcoes::validaValor($_POST['valor']);
    $data = filter_input(INPUT_POST, "data");
    $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
    $comentario = filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "tipo");
    $idUser = "2";
      
      
      if(!empty($descricao) and !empty($valor) and !empty($data) and !empty($categoria) and !empty($idUser)){


        echo "desc ".$descricao."<br>";
        echo "valor ".$valor."<br>";
        echo "data ".$data."<br>";
        echo "categoria ".$categoria."<br>";
        echo "coment ".$comentario."<br>";
        echo "tipo ".$tipo."<br>";
        echo "iduser ".$idUser."<br>";

        $controle = new \App\Model\Controle();
          
        $controle->setDescricao($descricao);
        $controle->setValor($valor);
        $controle->setData($data);
        $controle->setCategoria($categoria);
        $controle->setComentario($comentario);
        $controle->setTipo($tipo);
        $controle->setIdUser($idUser);

        $DBcontrole = new \App\Model\DBcontrole();
        $DBcontrole->insert($controle);
        
        $_SESSION['sucesso'] = "Movimentação cadastrada com sucesso!";
        header("Location: ../../index.php");
      }else{
        $_SESSION['erro'] = "Erro! É preciso preencher a porra toda.";
        header("Location: ../../index.php");
      }
    ?>