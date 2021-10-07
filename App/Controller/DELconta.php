<?php

session_start();

use App\Model\DBcontrole;
use App\Model\TipoGasto;

include_once("../Model/DBcontrole.php");
include_once("../Model/Controle.php");

$id = $_GET['id'];

if(!empty($id)){

    $conta = new \App\Model\DBcontrole();
    $conta->delete($id);

    $_SESSION['sucesso'] = "Movimentação excluída com sucesso.";
    header("Location: ../../index.php");

}else{
    $_SESSION['erro'] = "Erro!";
    header("Location: ../../index.php");
}