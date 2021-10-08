<?php

session_start();

include_once("../Model/DBcontrole.php");
include_once("../Model/Controle.php");
include_once("../Model/DBtipoGasto.php");
include_once("../Model/TipoGasto.php");

$id = $_GET['id'];

if(!empty($id)){

    $categoria = new \App\Model\DBtipoGasto();

    
    $categoria->delete($id);

    $_SESSION['sucesso'] = "Categoria excluída com sucesso.";
    header("Location: ../../index.php");

}