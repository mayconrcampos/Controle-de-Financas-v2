<?php

session_start();

use App\Model\DBcontrole;
use App\Model\DBtipoGasto;
use App\Model\Controle;
use App\Model\TipoGasto;

include_once("../Model/DBcontrole.php");
include_once("../Model/Controle.php");
include_once("../Model/TipoGasto.php");
include_once("../Model/DBtipoGasto.php");
//include_once("../Controller/Funcoes.php");

$categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, "tipo");
$id = $_POST['id'];

$idUser = "2";

//echo "categoria ".$categoria."<br>";

if(!empty($categoria)){

    $tipoGasto = new \App\Model\TipoGasto();
    $tipoGasto->setCategoria($categoria);
    $tipoGasto->setTipo($tipo);
    $tipoGasto->setID($id);
    $tipoGasto->setIdUser($idUser);

    //echo $tipoGasto->getCategoria();
    //echo $tipoGasto->getTipo();
    //echo $tipoGasto->getID();
    //echo $tipoGasto->getIdUser();

    $editaTipoGasto = new \App\Model\DBtipoGasto();
    $editaTipoGasto->update($tipoGasto);

    $_SESSION['sucesso'] = "Categoria editada com sucesso.";
    header("Location: ../../index.php");

}else{
    $_SESSION['erro'] = "Erro ao editar categoria.";
    header("Location: ../../index.php");
}